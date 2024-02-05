<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $name  = $con->real_escape_string(htmlentities($_POST['service_name']));



  //$ins = $con->query("INSERT services VALUES('','$name','0','0')");
  $ins = $con->query("INSERT INTO services (service_name, equipment, id_sublinea) VALUES ('$name','0','0')");

if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=service&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar el servicio&c=service&p=fuera&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
