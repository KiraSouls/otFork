<?php include'../conn/connn.php';
require '../filtro/vendor/autoload.php';
include_once('../filtro/credentials.php');

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $fechaHoraActual = date('Y-m-d H:i');
  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $activities= $_POST['activities'];
  $comment= $con->real_escape_string(htmlentities($_POST['comment']));
  $number_ot= $con->real_escape_string(htmlentities($_POST['number_ot']));
  
  $ot_number = $number_ot;

  foreach($activities as $activity){
    $up_activity = $con->query("UPDATE tasks_equipments SET status='1' WHERE id='$activity' ");
  }


  $sel = $con->query("SELECT  * FROM  tasks_equipments WHERE number_ot = '$number_ot'");
  
  $row = mysqli_num_rows($sel);
  
   if ($activities == "" || $activities == count($activities) < $row){
    $up = $con->query("UPDATE ots SET status='finalizada', comment='$comment' WHERE id='$id'");

   }
   
   if(count($activities) == $row){
    $up2 = $con->query("UPDATE ots SET status='finalizada', comment='$comment' WHERE id='$id'");

   }



  if ($up || $up2) {
      
      // Envio de correos
    // Mis consultas
    
    // tabla ots // id id_client id_branch id_contact hours type description id_service leader priority status number comment
    
    // tabla participant // id participant_name description
    
    
    
    $id_client = $con ->query("SELECT id_client FROM ots WHERE number='$ot_number'");
    $id_client_row = $id_client->fetch_assoc();
    $id_client = $id_client_row['id_client'];
    
    $result = $con->query("SELECT id_branch, id_contact, hours, type, description, id_service, leader, priority, status, comment FROM ots WHERE number='$ot_number'");
    $row = $result->fetch_assoc();
    
    $id_branch = $row['id_branch'];
    $id_contact = $row['id_contact'];
    $hours = $row['hours'];
    $type = $row['type'];
    $description = $row['description'];
    $id_service = $row['id_service'];
    $leader = $row['leader'];
    $priority = $row['priority'];
    $status = $row['status'];
    $comment2 = $row['comment'];
    
    
    $result = $con->query("SELECT created_at FROM ots WHERE id='$id'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $created_at = $row['created_at'];
    } else {
        $created_at = ""; // En caso de no encontrar un valor de fecha de creación, asigna un valor por defecto
    }

    
    $email_contact = "";

    $result_contact = $con->query("SELECT contact_name FROM contacts WHERE id='$id_contact'");
    if ($result_contact->num_rows > 0) {
        $row_contact = $result_contact->fetch_assoc();
        $contact_name = $row_contact['contact_name'];
    }
    
        
    $result = $con->query("SELECT service_name FROM services WHERE id='$id_service'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $service_name = $row['service_name'];
    } else {
        $service_name = ""; // En caso de no encontrar un service_name correspondiente, asigna un valor por defecto
    }
    
    $techs_name = [];
    
    $result = $con->query("SELECT name FROM clients WHERE id='$id_client'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $client_name = $row['name'];
    }
    
    $participants = $con->query("SELECT participant_name FROM participants WHERE ot_number='$ot_number'");
    
    while ($row = $participants->fetch_assoc()) {
      $techs_name[] = $row['participant_name'];
    }
    
    
    $result_branch = $con->query("SELECT branch_name FROM branches WHERE id='$id_branch'");
    
    if ($result_branch->num_rows > 0) {
        $row_branch = $result_branch->fetch_assoc();
        $branch_name = $row_branch['branch_name'];
    } else {
        // Si no se encuentra una sucursal con el ID especificado, puedes asignar un valor por defecto
        $branch_name = "Nombre de Sucursal no encontrado";
    }
    
    
    // Correo cliente : 
    
    $email_contact = "";
    
    $result = $con->query("SELECT email FROM contacts WHERE id='$id_contact'");
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $email_contact = $row['email'];
    }
    
    $to_client = $email_contact; // Email del cliente
    $subject_client = 'Orden de trabajo finalizada';
    $headers_client = "From: SC Informatica <proyectos@scinformatica.cl>\r\n";
    $headers_client .= "Reply-To: proyectos@scinformatica.cl\r\n";
    $headers_client .= "MIME-Version: 1.0\r\n";
    $headers_client .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    $message_client = '
    <html>
    
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                background: #f8f9fa;
                font-family: Arial, sans-serif;
                font-size: 14px;
                color: #333;
            }
    
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
    
            h2 {
                margin-top: 0;
                color: #333;
                text-align: center;
            }
    
            h3 {
                margin-top: 0;
                color: #333;
                text-align: center;
            }
    
            h4 {
                margin-top: 0;
                color: #333;
                text-align: center;
            }
    
            p {
                margin-bottom: 10px;
                color: #333;
            }
    
            .table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
    
            .table th,
            .table td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ccc;
            }
    
            .table th {
                font-weight: bold;
                background-color: #f1f1f1;
            }
    
            .table tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }
    
            .footer {
                margin-top: 20px;
                text-align: center;
                color: #888;
                font-size: 12px;
            }
    
            .table-container {
                overflow-x: auto;
            }
    
            @media (max-width: 768px) {
                .table-container {
                    width: 100%;
                }
            }
    
            img {
                max-width: 100%;
                height: auto;
            }
        </style>
    </head>
    
    <body>
        <div class="container">
            <div style="text-align: center;">
                <img src="https://drive.google.com/uc?export=download&id=1hTk5ZVvHS3qBb3yThfmsy7pS8vySIxjY" alt=""> <br>
                <h2>Hola, ' . $contact_name . '</h2>
            </div>
    
            <h3 style="text-align: center;">la orden de trabajo ' . $ot_number . ' ha sido finalizada:</h3>
    
            <h3> ' . $comment  .'</h3> 
            
            <h3> ' . $fechaHoraActual .'</h3>
    
            <h4> Tipo ' .$service_name . ' </h4>
    
            <h4> ' .$description . ' </h4>
    
            <table class="table">
                <thead>
                    <tr>
                        <th>#Orden</th>
                        <th>Cliente</th>
                        <th>Sucursal</th>
                        <th>Servicio</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> ' . $ot_number . ' </td>
                        <td> ' . $client_name . ' </td>
                        <td> ' . $branch_name . '</td>
                        <td> ' . $service_name . ' </td>
                        <td> ' .$created_at . ' </td>
                    </tr>
                </tbody>
            </table> <br>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Responsable</th>
                        <th>Prioridad</th>
                        <th>Horas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> ' .  $leader . ' </td>
                        <td> ' .$priority . ' </td> 
                        <td> ' . $hours . ' </td>
                    </tr>
                </tbody>
            </table>
            <p>Este correo es generado automáticamente. Por favor, no es necesario responder.</p>
            <p> &copy;' . date('Y') . ' SCINFORMATICA. Todos los derechos reservados. </p>
        </div>
    </body>
    
    </html>';
    
    if (mail($to_client, $subject_client, $message_client, $headers_client)) {
        echo 'El correo se envió correctamente.';
    } else {
        echo 'Hubo un error al enviar el correo.';
    }
    
    
    
    
    
    
    
    
    
    
    
    
    // Correo tecnicos : 
    
    $emails = [];
    
    foreach ($techs_name as $name) {
      $result = $con->query("SELECT email FROM techs WHERE name='$name'");
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $emails[] = $row['email'];
      }
    }
    
    
    foreach ($emails as $email) {
                $to =  $email ; // email tecnico $email 
                $subject = 'Orden de trabajo finalizada';
                $headers = "From: SC Informatica <proyectos@scinformatica.cl>\r\n";
                $headers .= "Reply-To: proyectos@scinformatica.cl\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                
                $message = '
            <html>
            
            <head>
                <meta charset="UTF-8">
                <style>
                    body {
                        background: #f8f9fa;
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        color: #333;
                    }
            
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #fff;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
            
                    h2 {
                        margin-top: 0;
                        color: #333;
                        text-align: center;
                    }
                    
                    h3 {
                        margin-top: 0;
                        color: #333;
                        text-align: center;
                    }
                    
                    h4 {
                        margin-top: 0;
                        color: #333;
                        text-align: center;
                    }
            
                    p {
                        margin-bottom: 10px;
                        color: #333;
                    }
            
                    .table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                    }
            
                    .table th,
                    .table td {
                        padding: 8px;
                        text-align: left;
                        border-bottom: 1px solid #ccc;
                    }
            
                    .table th {
                        font-weight: bold;
                        background-color: #f1f1f1;
                    }
            
                    .table tbody tr:nth-child(even) {
                        background-color: #f9f9f9;
                    }
            
                    .footer {
                        margin-top: 20px;
                        text-align: center;
                        color: #888;
                        font-size: 12px;
                    }
            
                    .table-container {
                        overflow-x: auto;
                    }
            
                    @media (max-width: 768px) {
                        .table-container {
                            width: 100%;
                        }
                    }
            
                    img {
                        max-width: 100%;
                        height: auto;
                    }
                </style>
            </head>
            
            <body>
                <div class="container">
                    <div style="text-align: center;">
                        <img src="https://drive.google.com/uc?export=download&id=1hTk5ZVvHS3qBb3yThfmsy7pS8vySIxjY" alt="">  <br>
                        <h2>Hola, ' . $name . ' </h2>
                    </div>
            
                    <h3 style="text-align: center;">la orden de trabajo ' . $ot_number . ' ha sido finalizada:</h3>
                    
                    <h3> ' . $comment  .'</h3>
                    
                    <h3> ' . $fechaHoraActual .'</h3>
                    
                    <h4> Tipo ' .$service_name . ' </h4>
                    
                    <h4> ' .$description . ' </h4>
            
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#Orden</th>
                                <th>Cliente</th>
                                <th>Sucursal</th>
                                <th>Servicio</th>
                                <th>Fecha</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> ' . $ot_number . ' </td>
                                <td> ' . $client_name . ' </td>
                                <td> ' . $branch_name . '</td>
                                <td> ' . $service_name . ' </td>
                                <td> ' .$created_at . ' </td>
                            </tr>
                        </tbody>
                    </table> <br>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Responsable</th>
                                <th>Tecnico</th>
                                <th>Prioridad</th>
                                <th>Horas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> ' .  $leader . ' </td>
                                <td> ' . $valor . ' </td>
                                <td> ' .$priority . ' </td> 
                                <td> ' . $hours . ' </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Este correo es generado automáticamente. Por favor, no es necesario responder.</p>
                    <p> &copy;' . date('Y') . ' SCINFORMATICA. Todos los derechos reservados. </p>
                    
                </div>
            </body>
            
            </html>';
                
                if (mail($to, $subject, $message, $headers)) {
                    echo 'El correo se envi車 correctamente.';
                } else {
                    echo 'Hubo un error al enviar el correo.';
                }
                
    }
    
    
    
    
    
    // Correo al encargado : 
    
    
    $email_leader = "";
    
    $result = $con->query("SELECT email FROM users WHERE name='$leader'");
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $email_leader = $row['email'];
    }
    
    
    $leaderDifferent = true;
    
    foreach ($techs_name as $name) {
      if ($leader == $name) {
        $leaderDifferent = false;
        break;
      }
    }
    
    if ($leaderDifferent) {
      // Envía el correo solo una vez porque el encargado no se encuentra entre los técnicos
      
                $to_leader =  $email_leader ; // email tecnico $email 
                $subject_leader = 'Orden de trabajo finalizada';
                $headers_leader = "From: SC Informatica <proyectos@scinformatica.cl>\r\n";
                $headers_leader .= "Reply-To: proyectos@scinformatica.cl\r\n";
                $headers_leader .= "MIME-Version: 1.0\r\n";
                $headers_leader .= "Content-Type: text/html; charset=UTF-8\r\n";
                
                $message_leader = '
            <html>
            
            <head>
                <meta charset="UTF-8">
                <style>
                    body {
                        background: #f8f9fa;
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        color: #333;
                    }
            
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #fff;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
            
                    h2 {
                        margin-top: 0;
                        color: #333;
                        text-align: center;
                    }
                    
                    h3 {
                        margin-top: 0;
                        color: #333;
                        text-align: center;
                    }
                    
                    h4 {
                        margin-top: 0;
                        color: #333;
                        text-align: center;
                    }
            
                    p {
                        margin-bottom: 10px;
                        color: #333;
                    }
            
                    .table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                    }
            
                    .table th,
                    .table td {
                        padding: 8px;
                        text-align: left;
                        border-bottom: 1px solid #ccc;
                    }
            
                    .table th {
                        font-weight: bold;
                        background-color: #f1f1f1;
                    }
            
                    .table tbody tr:nth-child(even) {
                        background-color: #f9f9f9;
                    }
            
                    .footer {
                        margin-top: 20px;
                        text-align: center;
                        color: #888;
                        font-size: 12px;
                    }
            
                    .table-container {
                        overflow-x: auto;
                    }
            
                    @media (max-width: 768px) {
                        .table-container {
                            width: 100%;
                        }
                    }
            
                    img {
                        max-width: 100%;
                        height: auto;
                    }
                </style>
            </head>
            
            <body>
                <div class="container">
                    <div style="text-align: center;">
                        <img src="https://drive.google.com/uc?export=download&id=1hTk5ZVvHS3qBb3yThfmsy7pS8vySIxjY" alt="">  <br>
                        <h2>Hola, ' . $leader . ' </h2>
                    </div>
                    
                    
            
                    <h3 style="text-align: center;">la orden de trabajo ' . $ot_number . ' ha sido finalizada:</h3>
                    
                    <h3> ' . $comment  .'</h3>
                    
                    <h3> ' . $fechaHoraActual .'</h3>
                    
                    <h4> Tipo ' .$service_name . ' </h4>
                    
                    <h4> ' .$description . ' </h4>
            
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#Orden</th>
                                <th>Cliente</th>
                                <th>Sucursal</th>
                                <th>Servicio</th>
                                <th>Fecha</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> ' . $ot_number . ' </td>
                                <td> ' . $client_name . ' </td>
                                <td> ' . $branch_name . '</td>
                                <td> ' . $service_name . ' </td>
                                <td> ' .$created_at . ' </td>
                            </tr>
                        </tbody>
                    </table> <br>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Responsable</th>
                                <th>Tecnico</th>
                                <th>Prioridad</th>
                                <th>Horas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> ' .  $leader . ' </td>
                                <td> ' . $valor . ' </td>
                                <td> ' .$priority . ' </td> 
                                <td> ' . $hours . ' </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Este correo es generado automáticamente. Por favor, no es necesario responder.</p>
                    <p> &copy;' . date('Y') . ' SCINFORMATICA. Todos los derechos reservados. </p>
                    
                </div>
            </body>
            
            </html>';
                
                if (mail($to_leader, $subject_leader, $message_leader, $headers_leader)) {
                    echo 'El correo se envi車 correctamente.';
                } else {
                    echo 'Hubo un error al enviar el correo.';
                }
       
    }
             
    
    
    
    
    
    
    
    
        
        
        
        
        
        
        
    // Correos de respaldo 
    
    $tableRows = ''; // Variable para almacenar las filas de la tabla
    
    foreach ($techs_name as $name) {
        $tableRows .= '<tr>';
        $tableRows .= '<td>' . $name . '</td>';
        $tableRows .= '</tr>';
    }
    
    $to_copy = 'rmoya@scinformatica.cl ,  scinformatica@scinformatica.cl'; // lista de emails que recibirán el comprobante 
    $subject_copy = 'Comprobante de Orden: ' . $number . 'Finalizada ';
    $headers_copy = "From: SC Informatica <proyectos@scinformatica.cl>\r\n";
    $headers_copy .= "Reply-To: proyectos@scinformatica.cl\r\n";
    $headers_copy .= "MIME-Version: 1.0\r\n";
    $headers_copy .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message_copy = '
    
    <html>
    <head>
        <meta charset="UTF-8">
     <style>
            body {
                background: #f8f9fa;
                font-family: Arial, sans-serif;
                font-size: 14px;
                color: #333;
            }
    
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
    
            h2 {
                margin-top: 0;
                color: #333;
            }
            
            h3 {
                margin-top: 0;
                color: #333;
                text-align: center;
            }
            
            h4 {
                margin-top: 0;
                color: #333;
                text-align: center;
            }
    
            p {
                margin-bottom: 10px;
                color: #333;
            }
    
            .table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
    
            .table th,
            .table td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ccc;
            }
    
            .table th {
                font-weight: bold;
                background-color: #f1f1f1;
            }
    
            .table tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }
    
            .footer {
                margin-top: 20px;
                text-align: center;
                color: #888;
                font-size: 12px;
            }
    
            .table-container {
                overflow-x: auto;
            }
    
            @media (max-width: 768px) {
                .table-container {
                    width: 100%;
                }
            }
    
            img {
                max-width: 100%;
                height: auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Contenido del comprobante de orden -->
    
            <div style="text-align: center;">
                <img src="https://drive.google.com/uc?export=download&id=1hTk5ZVvHS3qBb3yThfmsy7pS8vySIxjY" alt=""> <br>
                <h2>Estimado/a miembro del equipo</h2>
            </div>
            
    
            <h3>la orden de trabajo ' . $ot_number . ' ha sido finalizada:</h3>
            
            <h3> ' . $comment  .'</h3>
            
            <h3> ' . $fechaHoraActual .'</h3>
    
            <h4> ' . $description . ' </h4>
            
            <h4> ' . $type . ' </h4>
    
            <table class="table">
                <thead>
                    <tr>
                        <th>Orden</th>
                        <th>Duración</th>
                        <th>Prioridad</th>
                        <th>Servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> ' . $ot_number . ' </td>
                        <td> ' . $hours . ' h </td>
                        <td> ' .$priority . ' </td>
                        <td> ' . $service_name . ' </td>
                    </tr>
                </tbody>
            </table>
    
            <table class="table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> ' . $client_name . ' </td>
                    </tr>
                </tbody>
            </table>
    
            <table class="table">
                <thead>
                    <tr>
                        <th>Responsable</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> ' .  $leader . ' </td>
                    </tr>
                </tbody>
            </table>
    
            <table class="table">
                <thead>
                    <tr>
                        <th>Técnicos</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    ' . $tableRows . '
                </tbody>
            </table>
    
            <p>Este correo es generado automáticamente. Por favor, no es necesario responder.</p>
            <p> &copy;' . date('Y') . ' SCINFORMATICA. Todos los derechos reservados.</p>
        </div>
    </body>
    </html>
    ';
    
    $participants = $_POST['participants'];
    
    if (mail($to_copy, $subject_copy, $message_copy, $headers_copy)) {
        echo 'El correo para el cliente se envi車 correctamente.';
    } else {
        echo 'Hubo un error al enviar el correo al cliente.';
    }

// Fin envio de correos 
      
      header('location:../extend/alerta.php?msj=Orden actualizada&c=cashier&p=tech&t=success&id='.$id.'');
      
    
    
  }else {
      header('location:../extend/alerta.php?msj=La orden no se pudo actualizar&c=cashier&p=tech&t=error&id='.$id.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');
}
