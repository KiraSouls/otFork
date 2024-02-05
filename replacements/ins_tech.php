<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $email = $con->real_escape_string(htmlentities($_POST['email']));
  $name  = $con->real_escape_string(htmlentities($_POST['name']));
  $hour_price = $con->real_escape_string(htmlentities($_POST['hour_price']));
  $rut = $con->real_escape_string(htmlentities($_POST['rut']));
  $phone = $con->real_escape_string(htmlentities($_POST['phone']));






  if (empty($email) || empty($name)) {
    header('location:../extend/alerta.php?msj=Hay un campo sin especificar&c=us&p=in&t=error');
    exit;
  }
  


  if (!empty($email)) {
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        header('location:../extend/alerta.php?msj=El correo ingresado no es valido&c=us&p=in&t=error');
        exit;
      }
  }

  $ins = $con->query("INSERT techs VALUES('','$name','$rut','$phone','$email','$hour_price')");
if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=tech&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar el contacto&c=us&p=in&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
