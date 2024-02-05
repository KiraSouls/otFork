<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  $email = $con->real_escape_string(htmlentities($_POST['client_email']));
  $name  = $con->real_escape_string(htmlentities($_POST['client_name']));
  $rut = $con->real_escape_string(htmlentities($_POST['client_rut']));
  $web = $con->real_escape_string(htmlentities($_POST['client_web']));
  $phone = $con->real_escape_string(htmlentities($_POST['client_phone']));



  if (empty($email) || empty($name)) {
    header('location:../extend/alerta.php?msj=Hay un campo sin especificar&c=us&p=in&t=error');
    exit;
  }


  $caracteres = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ ";

  for ($i=0; $i < strlen($nombre); $i++) {
    $buscar = substr($nombre,$i,1);
    if (strpos($caracteres,$buscar) === false) {
      header('location:../extend/alerta.php?msj=El nombre debe contener solo letras&c=us&p=in&t=error');
      exit;
    }
  }

  if (!empty($email)) {
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        header('location:../extend/alerta.php?msj=El correo ingresado no es valido&c=us&p=in&t=error');
        exit;
      }
  }

  //$ins = $con->query("INSERT clients VALUES('','$name','$rut','$web','$phone','$email')");
  $ins = $con->query("INSERT INTO clients (name, rut, web, phone, email) VALUES ('$name','$rut','$web','$phone','$email')");

if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=us&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar el usuario&c=us&p=in&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
