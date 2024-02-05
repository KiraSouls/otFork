<?php
include '../conn/connn.php';

require '../filtro/vendor/autoload.php';
// contains a variable called: $API_KEY that is the API Key.
// You need this API_KEY created on the Sendgrid website.
include_once('../filtro/credentials.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $activity_name = $con->real_escape_string(htmlentities($_POST['name']));
  $hours  = $con->real_escape_string(htmlentities($_POST['hours']));
  $created_at = date("Y-m-d H:i:s");




  //$ins = $con->query("INSERT activities VALUES('','$activity_name','$created_at','$hours','$id')");
  $ins = $con->query("INSERT INTO activities (name, created_at, hours, id_ot) VALUES ('$activity_name','$created_at','$hours','$id')");

if ($ins) {
  $FROM_EMAIL = 'desarrollo@scinformatica.cl';
        // they dont like when it comes from @gmail, prefers business emails
        $TO_EMAIL = 'rmoya@scinformatica.cl';
        // Try to be nice. Take a look at the anti spam laws. In most cases, you must
        // have an unsubscribe. You also cannot be misleading.
        $subject =   'Se agrego una nueva actividad a la orden';
        $from = new SendGrid\Email(null, $FROM_EMAIL);
        $to = new SendGrid\Email(null, $TO_EMAIL);
        $htmlContent = '<html> <body style="backgroud: #FFFFFF;font-family: Verdana; font-size: 14px;color:#1c1b1b;"> <div style=""> <h2>Hola, </h2> <p style="font-size:17px;">Actividad agregada a la orden</p> <p>Revisa los detalles</p> <p style="padding:15px;background-color:#ECF8FF;"><a style="font-weight:bold;color: #2BA6CB;" href="" target="_blank">aquí &raquo;</a> </p> <p style="font-size: 9px;">&copy; '.date('Y',time()).'SCINFORMATICA.Todos los derechos reservados.</p> </div> </body> </html>';
      
        // Create Sendgrid content
      
        $content = new SendGrid\Content("text/html",$htmlContent);
        // Create a mail object
        $mail = new SendGrid\Mail($from, $subject, $to, $content);
      
        $sg = new \SendGrid($API_KEY);
        $response = $sg->client->mail()->send()->post($mail);

    $up = $con->query("UPDATE ots SET status='pendiente'  WHERE id = '$id'  ");
  header('location:../extend/alerta.php?msj=La actividad se ingreso con exito, la orden se encuentra en estado PENDIENTE&c=ots&p=update_ot&t=success&id='.$id.'');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar la actividad&c=ots&p=update_ot&t=error&id='.$id.'');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=&t=error');
}
 ?>
