<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $name  = $con->real_escape_string(htmlentities($_POST['name']));
  $email  = $con->real_escape_string(htmlentities($_POST['email']));
  $phone  = $con->real_escape_string(htmlentities($_POST['phone']));



  //$ins = $con->query("INSERT executives VALUES('','$id','$name','$email','$phone')");
  $ins = $con->query("INSERT INTO executives (id_providers, name, email, phone) VALUES ('$id','$name','$email','$phone')");

if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=provider&p=up_provider&t=success&id='.$id.'');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar el ejecutivo(a)&c=provider&p=up_provider&t=error&id='.$id.'');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
