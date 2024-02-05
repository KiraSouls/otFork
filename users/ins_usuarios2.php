<?php
include '../conn/connn.php';
require '../filtro/vendor/autoload.php';
include_once('../filtro/credentials.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $correo = $con->real_escape_string(htmlentities($_POST['correo']));
  $pass1  = $con->real_escape_string(htmlentities($_POST['contra']));
  $nombre = $con->real_escape_string(htmlentities($_POST['nombre']));
  $bebida = $con->real_escape_string(htmlentities($_POST['bebida']));
  $pastel = $con->real_escape_string(htmlentities($_POST['pastel']));
  $dian = $con->real_escape_string(htmlentities($_POST['dian']));
  $mesn = $con->real_escape_string(htmlentities($_POST['mesn']));
  $anon = $con->real_escape_string(htmlentities($_POST['anon']));
  $apellido = $con->real_escape_string(htmlentities($_POST['apellido']));
  $rut = $con->real_escape_string(htmlentities($_POST['rut']));
  $comuna = $con->real_escape_string(htmlentities($_POST['comunas']));
  $region = $con->real_escape_string(htmlentities($_POST['regiones']));
  $ocupacion = $con->real_escape_string(htmlentities($_POST['ocupacion']));
  $nivel = "CLUBFIKA";


  if (!ctype_alpha($nivel)) {
    header('location:../extend/alerta.php?msj=Solo se permiten letras en el campo nivel&c=us&p=in&t=error');
  }

  $caracteres = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz ";

  for ($i=0; $i < strlen($nombre); $i++) {
    $buscar = substr($nombre,$i,1);
    if (strpos($caracteres,$buscar) === false) {
      header('location:../extend/alerta.php?msj=El nombre debe contener solo letras&c=salir&p=fuera&t=error');
      exit;
    }
  }

  $contra = strlen($pass1);
  if ($contra < 8 || $contra > 15 ) {
    header('location:../extend/alerta.php?msj=La contraseña debe contener al menos 8 caracteres&c=salir&p=fuera&t=error');
    exit;
  }

  if (!empty($correo)) {
      if (!filter_var($correo,FILTER_VALIDATE_EMAIL)) {
        header('location:../extend/alerta.php?msj=El correo ingresado no es valido&c=salir&p=fuera&t=error');
        exit;
      }
  }

  $keyreg=md5(time());
  $link= 'http://www.fika-coffeeshop.cl/mailvery.php?key='.$keyreg.'&co='.$correo;

  $FROM_EMAIL = 'contacto@fika-coffeeshop.cl';
  // they dont like when it comes from @gmail, prefers business emails
  $TO_EMAIL = $correo;
  // Try to be nice. Take a look at the anti spam laws. In most cases, you must
  // have an unsubscribe. You also cannot be misleading.
  $subject =   'correo de activación de tu cuenta';
  $from = new SendGrid\Email(null, $FROM_EMAIL);
  $to = new SendGrid\Email(null, $TO_EMAIL);
  $htmlContent = '<html> <body style="backgroud: #FFFFFF;font-family: Verdana; font-size: 14px;color:#1c1b1b;"> <div style=""> <h2>Hola '.$nombre.'</h2> <p style="font-size:17px;">Gracias por registrarte en la COMUNIDAD FIKA</p> <p>Solo queda un paso más para activar tu cuenta y disfrutar de todos los beneficios de un usuario registrado</p> <p style="padding:15px;background-color:#ECF8FF;"> Para activar tu cuenta por favor haz <a style="font-weight:bold;color: #2BA6CB;" href="'.$link.'" target="_blank">click aquí &raquo;</a> </p> <p style="font-size: 9px;">&copy; '.date('Y',time()).'FIKA COFFEE SHOP.Todos los derechos reservados.</p> </div> </body> </html>';

  // Create Sendgrid content

  $content = new SendGrid\Content("text/html",$htmlContent);
  // Create a mail object
  $mail = new SendGrid\Mail($from, $subject, $to, $content);

  $sg = new \SendGrid($API_KEY);
  $response = $sg->client->mail()->send()->post($mail);


  if ($response->statusCode() == 202) {
    $pass1  = sha1($pass1);
    $ins = $con->query("INSERT usuarios VALUES(NULL,'$nombre','$correo','$pass1','$nivel','$bebida','$dian','$mesn','$anon','$pastel','0','0','$keyreg','$apellido','$rut','$ocupacion','$region','$comuna')");

    if ($ins) {
        header('location:../extend/alerta.php?msj=Te enviaremos un correo para activar tu cuenta&c=salir&p=fuera&t=success');
    }else {
      header('location:../extend/alerta.php?msj=No se pudo ingresar el usuario&c=salir&p=fuera&t=error');
    }
    echo 'done';

    }else {

    echo 'false';
    }
  }
 ?>
