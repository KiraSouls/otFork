<?php
//error_reporting(ALL);
  include '../conn/connn.php';
	// You need to install the sendgrid client library so run: composer require sendgrid/sendgrid
	require 'vendor/autoload.php';
	// contains a variable called: $API_KEY that is the API Key.
	// You need this API_KEY created on the Sendgrid website.
	include_once('./credentials.php');

  /*Post Data*/
  $asunto = "Envio curriculum";
  $apellidos = $con->real_escape_string(htmlentities($_POST['apellido']));
  $nombre = $con->real_escape_string(htmlentities($_POST['nombre']));
  $correo = $con->real_escape_string(htmlentities($_POST['correo']));
  $sucu = $con->real_escape_string(htmlentities($_POST['sucu']));
  $sizeFile = $_FILES['archivo']['size'];
  $tempFile = $_FILES["archivo"]["tmp_name"];
  $nameFile = $_FILES['archivo']['name'];
// $file = $nameFile;
$file_encoded = base64_encode(file_get_contents($tempFile));
$attachment = new SendGrid\Attachment();
$attachment->setContent($file_encoded);
$attachment->setType($_FILES['archivo']['type']);
$attachment->setDisposition("attachment");
$attachment->setFilename($_FILES['archivo']['name']);

	$FROM_EMAIL = 'admin@fika-coffeeshop.cl';
	// they dont like when it comes from @gmail, prefers business emails
	$TO_EMAIL = "trabajo@fika-coffeeshop.cl";
	// Try to be nice. Take a look at the anti spam laws. In most cases, you must
	// have an unsubscribe. You also cannot be misleading.
	$subject = $asunto;
	$from = new SendGrid\Email(null, $FROM_EMAIL);
	$to = new SendGrid\Email(null, $TO_EMAIL);
	$htmlContent = ("<p>nombre: </p>$nombre<p>correo: </p>$correo<p>apellido: </p>$apellido<p>sucursal : </p>$sucu");

	// Create Sendgrid content

	$content = new SendGrid\Content("text/html",$htmlContent);
	// Create a mail object
	$mail = new SendGrid\Mail($from, $subject, $to, $content);
  // Agregar archivo
  $mail->addAttachment($attachment);

	$sg = new \SendGrid($API_KEY);
	$response = $sg->client->mail()->send()->post($mail);

	if ($response->statusCode() == 202) {
		// Successfully sent
		header('location:../extend/alerta.php?msj=Datos enviados&c=salir&p=fuera&t=success&id');
	} else {
		header('location:../extend/alerta.php?msj=No se pudo realizar el envio de datos&c=salir&p=fuera&t=error');
	}

?>
