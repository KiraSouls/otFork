<?php
include '../conn/connn.php';

$asunto = $con->real_escape_string(htmlentities($_POST['asunto']));

require("PHPMailer/PHPMailerAutoload.php");

$mail = new PHPMailer;

$mail->IsSMTP();
$mail->Host = 'smtp.sendgrid.net';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'luis.torralbo';
$mail->Password = 'fikaclub123';
$mail->SMTPSecure = 'tls';

// Ahora configuraremos los parámetros básicos de PHPMailer para hacer un envío típico

$mail->From = 'luis.torralbo@inacapmail.cl'; // Nuestro correo electrónico
$mail->FromName = 'FIKA COFFEE SHOP'; // El nombre de nuestro sitio o proyecto
$mail->IsHTML(true); // Indicamos que el email tiene formato HTML
$mail->Subject = $asunto; // El asunto del email
$mail->Body = 'Hola, soy el cuerpo del mensaje :)'; // El cuerpo de nuestro mensaje

$mail->AddAddress('luis.torralbo20@gmail.com');
$mail->Send();

 ?>
