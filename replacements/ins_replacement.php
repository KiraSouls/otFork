<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  $name  = $con->real_escape_string(htmlentities($_POST['name']));
  $description = $con->real_escape_string(htmlentities($_POST['description']));
  $brand = $con->real_escape_string(htmlentities($_POST['brand']));
  $price = $con->real_escape_string(htmlentities($_POST['price']));


  $ins = $con->query("INSERT replacements VALUES('','$name','$brand','$price','$description')");
if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=replacement&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar el repuesto&c=replacement&p=fuera&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
