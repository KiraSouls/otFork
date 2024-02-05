<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $email = $con->real_escape_string(htmlentities($_POST['email']));
  $name  = $con->real_escape_string(htmlentities($_POST['name']));
  $location = $con->real_escape_string(htmlentities($_POST['location']));
  $phone = $con->real_escape_string(htmlentities($_POST['phone']));
  $rut= $con->real_escape_string(htmlentities($_POST['rut']));



  //$ins = $con->query("INSERT providers VALUES('','$name','$location','$phone','$email','$rut')");
   $ins = $con->query("INSERT INTO providers (name, location, phone, email, rut) VALUES ('$name','$location','$phone','$email','$rut')");

  
if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=provider&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar el contacto&c=provider&p=fuera&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
