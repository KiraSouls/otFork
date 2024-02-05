<?php


include '../conn/connn.php';


require_once ('vendor/autoload.php');

/*Post Data*/

$asunto = $con->real_escape_string(htmlentities($_POST['asunto']));

for($i=0; $i<count($_SESSION['correos']);$i++) {
/*Content*/
$from = new SendGrid\Email("FIKA COFFEE SHOP", "luis.torralbo@inacapmail.cl");
$subject = $asunto;
$to = new SendGrid\Email("Luis",$_SESSION['correos'][$i]);
$content = new SendGrid\Content("text/html", "Correo 2");

/*Send the mail*/
$mail = new SendGrid\Mail($from, $subject, $to, $content);
$apiKey = ('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');
$sg = new \SendGrid($apiKey);

/*Response*/
$response = $sg->client->mail()->send()->post($mail);

    var_dump($response);

}


?>
