<?php
  include '../conn/connn.php';
	// You need to install the sendgrid client library so run: composer require sendgrid/sendgrid
	require 'vendor/autoload.php';
	// contains a variable called: $API_KEY that is the API Key.
	// You need this API_KEY created on the Sendgrid website.
	include_once('./credentials.php');

  /*Post Data*/
  $asunto = $con->real_escape_string(htmlentities($_POST['asunto']));
  $correo = $con->real_escape_string(htmlentities($_POST['correo']));


	$FROM_EMAIL = 'fika-coffeeshop@fika-coffeeshop.cl';
	// they dont like when it comes from @gmail, prefers business emails
	$TO_EMAIL = $correo;
	// Try to be nice. Take a look at the anti spam laws. In most cases, you must
	// have an unsubscribe. You also cannot be misleading.
	$subject =   $asunto;
	$from = new SendGrid\Email(null, $FROM_EMAIL);
	$to = new SendGrid\Email(null, $TO_EMAIL);
	$htmlContent = '<!doctype html> <html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"> <head> <meta charset="utf-8"> <meta name="viewport" content="width=device-width"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="x-apple-disable-message-reformatting"> <title>FIKA COFFEE SHOP</title> <!--[if gte mso 9]> <xml> <o:OfficeDocumentSettings> <o:AllowPNG/> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml> <![endif]--> </head> <body style="margin:0; padding:0; background:#eeeeee;"> <center> <div style="width:100%; max-width:600px; background:#ffffff; padding:30px 20px; text-align:left; font-family: Arial, sans-serif;"> <!--[if mso]> <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" bgcolor="#ffffff"> <tr> <td align="left" valign="top" style="font-family: Arial, sans-serif; padding:20px;"> <![endif]--> <a href="http://www.fika-coffeeshop.cl"> <img src="https://i.ibb.co/QjrxwTq/fikaemail.jpg" style="display:block; margin-bottom:30px;"> </a><hr style="border:none; height:1px; color:#dddddd; background:#dddddd; width:100%; margin-bottom:20px;"> <p style="font-size:12px; line-height:18px; color:#999999; margin-bottom:10px;"> clic <a href="http://fika-coffeeshop.cl" style="font-size:12px; line-height:18px; color:#666666; font-weight:bold;"> aquí</a> para abandonar esta lista de correo. </p> <p style="font-size:12px; line-height:18px; color:#999999; margin-bottom:10px;"> &copy; Copyright 2019 <a href="http://fika-coffeeshop.cl" style="font-size:12px; line-height:18px; color:#666666; font-weight:bold;"> WWW.FIKA-COFFEESHOP.CL</a>, All Rights Reserved. </p> </div> </center> </body> </html>';

	// Create Sendgrid content

	$content = new SendGrid\Content("text/html",$htmlContent);
	// Create a mail object
	$mail = new SendGrid\Mail($from, $subject, $to, $content);

	$sg = new \SendGrid($API_KEY);
	$response = $sg->client->mail()->send()->post($mail);

	if ($response->statusCode() == 202) {
		// Successfully sent
        header('location:../extend/alerta.php?msj=Correo enviado&c=us&p=in&t=success');
	} else {
		echo 'false';
	}


?>
