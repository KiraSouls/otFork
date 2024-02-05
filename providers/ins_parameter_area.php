<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  $name  = $con->real_escape_string(htmlentities($_POST['nueva_area']));



  //$ins = $con->query("INSERT parameter_area VALUES('','$name')");
  
 $ins = $con->query("INSERT INTO parameter_area (name) VALUES ('$name')");

if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=tech&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar el contacto&c=tech&p=fuera&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
