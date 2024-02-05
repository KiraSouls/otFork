<?php
include '../conn/connn.php';


require_once ('vendor/autoload.php');
function enviarComentario($correo, $comentario,$nombre,$sucursal,$fechavisita,$horavisita)
{
  if ($sucursal=="3norte") {
    $from = new SendGrid\Email("FIKA COFFEE SHOP", "luis.torralbo@inacapmail.cl");
    $subject = "Comentario";
    $to = new SendGrid\Email("Luis","fika1@fika-coffeeshop.cl");
    $content = new SendGrid\Content("text/html","<p>nombre: </p>$nombre<p>correo: </p>$correo<p>comentario: </p>$comentario<p>fecha de visita: </p>$fechavisita<p>hora de visita: </p>$horavisita");

    /*Send the mail*/
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey = ('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');
    $sg = new \SendGrid($apiKey);

    

        var_dump($response);
  }if ($sucursal=="Av.benidorm") {
    $from = new SendGrid\Email("FIKA COFFEE SHOP", "luis.torralbo@inacapmail.cl");
    $subject = "Comentario";
    $to = new SendGrid\Email("Luis","fika2@fika-coffeeshop.cl");
    $content = new SendGrid\Content("text/html", "<p>nombre: </p>$nombre<p>correo: </p>$correo<p>comentario: </p>$comentario<p>fecha de visita: </p>$fechavisita<p>hora de visita: </p>$horavisita");

    /*Send the mail*/
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey = ('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');
    $sg = new \SendGrid($apiKey);

    /*Response*/
    $response = $sg->client->mail()->send()->post($mail);

        var_dump($response);
  }if ($sucursal=="Av.libertad") {
    $from = new SendGrid\Email("FIKA COFFEE SHOP", "luis.torralbo@inacapmail.cl");
    $subject = "Comentario";
    $to = new SendGrid\Email("Luis","fika3@fika-coffeeshop.cl");
    $content = new SendGrid\Content("text/html", "<p>nombre: </p>$nombre<p>correo: </p>$correo<p>comentario: </p>$comentario<p>fecha de visita: </p>$fechavisita<p>hora de visita: </p>$horavisita");

    /*Send the mail*/
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey = ('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');
    $sg = new \SendGrid($apiKey);

    /*Response*/
    $response = $sg->client->mail()->send()->post($mail);

        var_dump($response);
  }

} ?>
