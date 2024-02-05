<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $name  = $con->real_escape_string(htmlentities($_POST['brand_name']));



  //$ins = $con->query("INSERT brands VALUES('','$name')");
    $ins = $con->query("INSERT INTO brands (name) VALUES ('$name')");

if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=equipment&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar la marca&c=equipment&p=fuera&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
