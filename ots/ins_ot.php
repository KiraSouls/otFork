<?php
include '../conn/connn.php';
require '../filtro/vendor/autoload.php';
// contains a variable called: $API_KEY that is the API Key.
// You need this API_KEY created on the Sendgrid website.
include_once('../filtro/credentials.php');

date_default_timezone_set("America/Santiago");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sel2 = $con->query("SELECT number FROM ots ORDER BY id DESC LIMIT 1");
    while ($f = $sel2->fetch_assoc()) {
        $number = $f['number'];
    }




    $client  = $con->real_escape_string(htmlentities($_POST['client']));
    $branch = $con->real_escape_string(htmlentities($_POST['branch']));
    $contact = $con->real_escape_string(htmlentities($_POST['contact']));
    $hours = $con->real_escape_string(htmlentities($_POST['hours']));

    $type = $con->real_escape_string(htmlentities($_POST['type']));
    $description = $con->real_escape_string(htmlentities($_POST['description']));
    $service = $con->real_escape_string(htmlentities($_POST['service']));
    $leader = $con->real_escape_string(htmlentities($_POST['leader']));
    $priority = $_POST['priority'];
    $status = "iniciada";
    $number = $number + 1;

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
    $equipment = $_POST['equipment'];
    $created_at = date("Y-m-d H:i:s");
    $participants = $_POST['participants'];
    $equipos = $_POST['e_count'];





    $ins = $con->query("INSERT INTO ots (id_client, id_branch, id_contact, hours, created_at, type, description, id_service, leader, priority, status, number, comment
     , detalle, accesorios, rayones, rupturas, tornillos, gomas, estado, observaciones, cargador, cable, adaptador, bateria, pantalla, teclado, drum, toner) VALUES ('$client', '$branch', '$contact', '$hours', '$created_at', '$type', '$description', '$service', '$leader', '$priority', '$status', '$number', '', 
      '$detalle', '$accesorios', '$rayones', '$rupturas', '$tornillos', '$gomas', '$estado', '$observaciones', '$cargador', '$cable', '$adaptador', '$bateria', '$pantalla', '$teclado', '$drum', '$toner')");




    // Mis consultas
    $service_name = $con->query("SELECT service_name FROM services WHERE id='$service'");
    $branch_name = $con->query("SELECT branch_name FROM branches WHERE id='$branch'");
    $client_name = $con->query("SELECT name FROM clients WHERE id='$client'");
    $client_email = $con->query("SELECT email FROM clients WHERE id='$client'");

    $service_row = $service_name->fetch_assoc();
    $branch_row = $branch_name->fetch_assoc();
    $client_row = $client_name->fetch_assoc();
    $client_email_row = $client_email->fetch_assoc();

    $service_name = $service_row['service_name'];
    $branch_name = $branch_row['branch_name'];
    $client_name = $client_row['name'];
    $client_email = $client_email_row['email'];

    $contact_email = $con->query("SELECT email FROM contacts WHERE id='$contact'");
    $contact_email_row = $contact_email->fetch_assoc();
    $contact_email = $contact_email_row['email'];



    if ($ins) {


        foreach ($task as $val) {
            $ins3 = $con->query("INSERT INTO tasks_equipments (id_tasks, id_equipment, number_ot, task_set, comment, status) VALUES ('$val','$equipment','$number','1','','0')");
        }

        for ($f = 2; $f <= $equipos; $f++) {
            foreach ($_POST['task' . $f] as $val) {
                $equips = $_POST['equipment' . $f];
                $ins4 = $con->query("INSERT INTO tasks_equipments (id_tasks, id_equipment, number_ot, task_set, comment, status) VALUES ('$val','$equips','$number','$f','','0')");
            }
        }


        foreach ($participants as $valor) {


            // Consultas para guardar el id como clave foranea

            $userId = null; // Variable para almacenar el id de la tabla users
            $sel4 = $con->query("SELECT id FROM users WHERE name='$valor'");
            if ($sel4->num_rows > 0) {
                // Si se encontró un registro en la tabla users con el mismo nombre, guardar el id en la variable $userId
                $userRow = $sel4->fetch_assoc();
                $userId = $userRow['id'];
            } else {
                // Si no se encontró un registro en la tabla users con el mismo nombre, asignar null a la variable $userId
                $userId = null;
            }

            $ins2 = $con->query("INSERT INTO participants (participant_name, description, ot_number, users_id) VALUES ('$valor','$description','$number', '$userId')");

            $sel3 = $con->query("SELECT email FROM techs WHERE name='$valor'");
            while ($k = $sel3->fetch_assoc()) {
                $email = $k['email'];
            }


            $to =  $email; // email tecnico $email
            $subject = 'Nueva orden de trabajo';
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
            <h2>Hola, ' . $valor . '</h2>
        </div>

        <h3 style="text-align: center;">Tienes una nueva orden de trabajo </h3>

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




        // C車digo para enviar correo al cliente despu谷s del bucle
        $to_cliente = $contact_email; // Email del cliente
        $subject_cliente = 'Nueva Orden';
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
            <img src="https://drive.google.com/uc?export=download&id=1hTk5ZVvHS3qBb3yThfmsy7pS8vySIxjY" alt=""> <br>
            <h2>Hola, ' . $client_name . '</h2>
        </div>

        <h3> Se ha creado una nueva orden </h3>

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


        if (mail($to_cliente, $subject_cliente, $message_cliente, $headers_cliente)) {
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

        $to_copy = 'rmoya@scinformatica.cl ,  scinformatica@scinformatica.cl'; // lista de emails que recibirán el comprobante
        $subject_copy = 'Nuevo Comprobante de Orden: ' . $number;
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
            <h2>Estimado/a miembro del equipo,</h2>
        </div>

        <h3>Nos complace informarles que se ha generado una nueva orden en nuestros registros. A continuación, encontrarán los detalles de la orden:</h3>
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












        header('location:../extend/alerta.php?msj=Se ingreso con exito&c=ots&p=fuera&t=success');
    } else {
        header('location:../extend/alerta.php?msj=No se pudo ingresar la orden&c=ots&p=fuera&t=error');
    }

    $con->close();
} else {
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
