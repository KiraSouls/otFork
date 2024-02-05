<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $brand_name = $con->real_escape_string(htmlentities($_POST['brand_name']));
  $model_name  = $con->real_escape_string(htmlentities($_POST['model_name']));
  $equipment_name = $con->real_escape_string(htmlentities($_POST['equipment_name']));
  $serie_number = $con->real_escape_string(htmlentities($_POST['serie_number']));
  $pal_number = $con->real_escape_string(htmlentities($_POST['pal_number']));

  //$ins = $con->query("INSERT equipment VALUES('','20','$equipment_name','$model_name','$pal_number','$serie_number','$brand_name')");
  //$ins = $con->query("INSERT INTO equipment (id_branches, id_model, series_number, id_linea) VALUES ('20','$equipment_name','$model_name','$pal_number','$serie_number','$brand_name')");

if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=tech&p=up_tech&t=success');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar el equipo&c=us&p=in&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
