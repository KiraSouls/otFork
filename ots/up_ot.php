<?php include '../conn/connn.php';

require '../filtro/vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $con->real_escape_string(htmlentities($_POST['id']));

    $client  = $con->real_escape_string(htmlentities($_POST['client']));
    $branch = $con->real_escape_string(htmlentities($_POST['branch']));
    $contact = $con->real_escape_string(htmlentities($_POST['contact']));
    $hours = $con->real_escape_string(htmlentities($_POST['hours']));
    $type = $con->real_escape_string(htmlentities($_POST['type']));
    $description = $con->real_escape_string(htmlentities($_POST['description']));
    $service = $con->real_escape_string(htmlentities($_POST['service']));
    $leader = $con->real_escape_string(htmlentities($_POST['leader']));
    $priority = $con->real_escape_string(htmlentities($_POST['priority']));
    $status = $_POST['status'];
    $number = $_POST['number_ot'];

    $detalle = $con->real_escape_string(htmlentities($_POST['deta']));
    $accesorios = $con->real_escape_string(htmlentities($_POST['acce']));
    $rayones = $con->real_escape_string(htmlentities($_POST['rayones']));
    $rupturas = $con->real_escape_string(htmlentities($_POST['rupturas']));
    $tornillos = $con->real_escape_string(htmlentities($_POST['tornillos']));
    $gomas = $con->real_escape_string(htmlentities($_POST['gomas']));
    $estado = $con->real_escape_string(htmlentities($_POST['estado']));
    $observaciones = $con->real_escape_string(htmlentities($_POST['obs']));
    $cargador = $con->real_escape_string(htmlentities($_POST['cargador']));
    $cable = $con->real_escape_string(htmlentities($_POST['cable']));
    $adaptador = $con->real_escape_string(htmlentities($_POST['adaptador']));
    $bateria = $con->real_escape_string(htmlentities($_POST['bateria']));
    $pantalla = $con->real_escape_string(htmlentities($_POST['pantalla']));
    $teclado = $con->real_escape_string(htmlentities($_POST['teclado']));
    $drum = $con->real_escape_string(htmlentities($_POST['drum']));
    $toner = $con->real_escape_string(htmlentities($_POST['toner']));

    $task = $_POST['task'];
    $task2 = $_POST['task2'];
    $task3 = $_POST['task3'];
    $task4 = $_POST['task4'];
    $task5 = $_POST['task5'];
    $task6 = $_POST['task6'];

    $equipment = $_POST['equipment'];
    $equipment2 = trim($_POST['equipment2']);
    $equipment3 = trim($_POST['equipment3']);
    $equipment4 = trim($_POST['equipment4']);
    $equipment5 = trim($_POST['equipment5']);
    $equipment6 = trim($_POST['equipment6']);

    $participants = $_POST['participants'];








    $eli_tasks_equipment = $con->query("DELETE  FROM tasks_equipments WHERE number_ot='$number' ");


    $eli_participants = $con->query("DELETE  FROM participants WHERE ot_number='$number' ");

    foreach ($task as $val) {


        //$ins3 = $con->query("INSERT tasks_equipments VALUES('','$val','','$number','1','','0')");
        $ins3 = $con->query("INSERT INTO tasks_equipments (id_tasks, id_equipment, number_ot, task_set, comment, status) VALUES ('$val','2','$number','1','2','0')");
    }


    $up1 = $con->query("UPDATE tasks_equipments SET id_equipment='$equipment' WHERE number_ot='$number' AND task_set=1 ");

    foreach ($participants as $valor) {


        //$ins2 = $con->query("INSERT participants VALUES('','$valor','$description','$number')");
        $ins2 = $con->query("INSERT INTO participants (participant_name, description, ot_number) VALUES ('$valor','$description','$number')");


        $sel3 = $con->query("SELECT email FROM techs WHERE name='$valor'");

        while ($k = $sel3->fetch_assoc()) {
            $email = $k['email'];
        }


        // Consultas para el correo :

        $service_name = $con->query("SELECT service_name FROM services WHERE id='$service'");
        $branch_name = $con->query("SELECT branch_name FROM branches WHERE id='$branch'");
        $client_name = $con->query("SELECT name FROM clients WHERE id='$client'");
        $client_email = $con->query("SELECT email FROM clients WHERE id='$client'");
        $created_at = $con->query("SELECT created_at FROM ots WHERE number='$number'");

        $service_row = $service_name->fetch_assoc();
        $branch_row = $branch_name->fetch_assoc();
        $client_row = $client_name->fetch_assoc();
        $client_email_row = $client_email->fetch_assoc();
        $created_at_row = $created_at->fetch_assoc();

        $service_name = $service_row['service_name'];
        $branch_name = $branch_row['branch_name'];
        $client_name = $client_row['name'];
        $client_email = $client_email_row['email'];
        $created_at = $created_at_row['created_at'];


        $contact_id = $con->query("SELECT id_contact from ots where number = '$number_ot' ");

        $contact_id_row = $contact_id->fetch_assoc();
        $contact_id = $contact_id_row['id_contact'];


        $contact_email = $con->query("SELECT email from contacts where id = '$contact_id' ");

        $contact_email_row = $contact_email->fetch_assoc();
        $contact_email = $contact_email_row['email'];





        // Enviar correo

        if ($status == "finalizada") {

            // Correo técnicos :

            $to =  $email; // email tecnico $email
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
                    <img src="https://drive.google.com/uc?export=download&id=1hTk5ZVvHS3qBb3yThfmsy7pS8vySIxjY" alt="">
                    <h2>Hola, ' . $valor . '</h2>
                </div>

                <h3 style="text-align: center;">La orden de trabajo ha sido finalizada</h3>

                <h4> Tipo ' . $type . ' </h4>

                <h4> ' . $description . ' </h4>

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
                            <td> ' . $number . ' </td>
                            <td> ' . $client_name . ' </td>
                            <td> ' . $branch_name . '</td>
                            <td> ' . $service_name . ' </td>
                            <td> ' . $created_at . ' </td>
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
                            <td> ' . $priority . ' </td>
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
    }


    if ($status == "finalizada") {

        // Correo clientes :

        $to_cliente = $client_contact; // Email del cliente
        $subject_cliente = 'Orden finalizada';
        $headers_cliente = "From: SC Informatica <proyectos@scinformatica.cl>\r\n";
        $headers_cliente .= "Reply-To: proyectos@scinformatica.cl\r\n";
        $headers_cliente .= "MIME-Version: 1.0\r\n";
        $headers_cliente .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message_cliente = '

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
                <div style="text-align: center;">
                    <img src="https://drive.google.com/uc?export=download&id=1hTk5ZVvHS3qBb3yThfmsy7pS8vySIxjY" alt="">
                    <h2>Hola, ' . $client_name . '</h2>
                </div>

                <h3> Se ha finalizado la orden ' . $number . '  </h3>

                <h4> ' . $description . ' </h4>

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
                            <td> ' . $number . ' </td>
                            <td> ' . $client_name . ' </td>
                            <td> ' . $branch_name . '</td>
                            <td> ' . $service_name . ' </td>
                            <td> ' . $created_at . ' </td>
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
                            <td> ' . $priority . ' </td>
                            <td> ' . $hours . ' </td>
                        </tr>
                    </tbody>
                </table>
                <p>Este correo es generado automáticamente. Por favor, no es necesario responder.</p>
                <p> &copy;' . date('Y') . ' SCINFORMATICA. Todos los derechos reservados. </p>

            </div>
        </body>

        </html>';


        if (mail($to_cliente, $subject_cliente, $message_cliente, $headers)) {
            echo 'El correo para el cliente se envi車 correctamente.';
        } else {
            echo 'Hubo un error al enviar el correo al cliente.';
        }







        // Correos de respaldo

        $tableRows = ''; // Variable para almacenar las filas de la tabla

        foreach ($participants as $participant) {
            $tableRows .= '<tr>';
            $tableRows .= '<td>' . $participant . '</td>';
            $tableRows .= '</tr>';
        }

        $to_copy = 'rmoya@scinformatica.cl ,  scinformatica@scinformatica.cl '; // lista de emails que recibirán el comprobante
        $subject_copy = ' Comprobante de Orden Completada : ' . $number;
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
            <img src="https://drive.google.com/uc?export=download&id=1hTk5ZVvHS3qBb3yThfmsy7pS8vySIxjY" alt="">
            <h2>Estimado/a miembro del equipo,</h2>
        </div>

        <h3>Nos complace informarle que la Orden de Trabajo ha sido completada. A continuación, encontrarán los detalles de la orden:</h3>
        <h3> ' . $created_at  . '</h3>

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
                    <td> ' . $number . ' </td>
                    <td> ' . $hours . ' h </td>
                    <td> ' . $priority . ' </td>
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

        //



    }








    foreach ($task2 as $vale) {

        //$ins4 = $con->query("INSERT tasks_equipments VALUES('','$vale','','$number','2','','0')");
        $ins4 = $con->query("INSERT INTO tasks_equipments (id_tasks, id_equipment, number_ot, task_set, comment, status) VALUES ('$vale','','$number','2','','0')");
    }

    $up4 = $con->query("UPDATE tasks_equipments SET id_equipment='$equipment2' WHERE number_ot='$number' AND task_set=2 ");




    foreach ($task3 as $vali) {

        //$ins5 = $con->query("INSERT tasks_equipments VALUES('','$vali','','$number','3','','0')");
        $ins5 = $con->query("INSERT INTO tasks_equipments (id_tasks, id_equipment, number_ot, task_set, comment, status) VALUES ('$vali','','$number','3','','0')");
    }

    $up5 = $con->query("UPDATE tasks_equipments SET id_equipment='$equipment3' WHERE number_ot='$number' AND task_set=3 ");



    foreach ($task4 as $va) {

        //$ins6 = $con->query("INSERT tasks_equipments VALUES('','$va','','$number','4','','0')");
        $ins6 = $con->query("INSERT INTO tasks_equipments (id_tasks, id_equipment, number_ot, task_set, comment, status) VALUES ('$va','','$number','4','','0')");
    }

    $up6 = $con->query("UPDATE tasks_equipments SET id_equipment='$equipment4' WHERE number_ot='$number' AND task_set=4 ");

    foreach ($task5 as $v) {
        //$ins7 = $con->query("INSERT tasks_equipments VALUES('','$v','','$number','5','','0')");
        $ins7 = $con->query("INSERT INTO tasks_equipments (id_tasks, id_equipment, number_ot, task_set, comment, status) VALUES ('$v','','$number','5','','0')");
    }

    $up7 = $con->query("UPDATE tasks_equipments SET id_equipment='$equipment5' WHERE number_ot='$number' AND task_set=5 ");

    foreach ($task6 as $valuex) {
        //$ins8 = $con->query("INSERT tasks_equipments VALUES('','$valuex','','$number','6','','0')");
        $ins8 = $con->query("INSERT INTO tasks_equipments (id_tasks, id_equipment, number_ot, task_set, comment, status) VALUES ('$valuex','','$number','6','','0')");
    }

    $up8 = $con->query("UPDATE tasks_equipments SET id_equipment='$equipment6' WHERE number_ot='$number' AND task_set=6 ");

    foreach ($task6 as $vol) {
        //$ins9 = $con->query("INSERT tasks_equipments VALUES('','$vol','','$number','7','','0')");
        $ins9 = $con->query("INSERT INTO tasks_equipments (id_tasks, id_equipment, number_ot, task_set, comment, status) VALUES ('$vol','','$number','7','','0')");
    }

    $up9 = $con->query("UPDATE tasks_equipments SET id_equipment='$equipment7' WHERE number_ot='$number' AND task_set=7 ");








    $up = $con->query("UPDATE ots SET id_client='$client', id_branch='$branch', id_contact='$contact', hours='$hours', type='$type'
    , description='$description', id_service='$service', leader='$leader', priority='$priority', status='$status',
    detalle='$detalle' , accesorios= '$accesorios', rayones='$rayones', rupturas='$rupturas', tornillos='$tornillos', gomas='$gomas', estado='$estado'
     , observaciones='$observaciones', cargador='$cargador', cable='$cable', adaptador='$adaptador', bateria='$bateria', pantalla='$pantalla', teclado='$teclado'
     , drum='$drum', toner='$toner'
      WHERE id='$id' ");


    if ($up) {
        header('location:../extend/alerta.php?msj=Orden actualizado&c=ots&p=fuera&t=success&id=' . $id . '');
    } else {
        header('location:../extend/alerta.php?msj=La orden no se pudo actualizar&c=ots&p=update_ot&t=error&id=' . $id . '');
    }

    $con->close();
} else {
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id=' . $id . '');
}
