<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $model_name  = $con->real_escape_string(htmlentities($_POST['model_name']));
  $equipment_name = $con->real_escape_string(htmlentities($_POST['equipment_name']));
  $serie_number = $con->real_escape_string(htmlentities($_POST['serie_number']));
  $branch = $con->real_escape_string(htmlentities($_POST['branch']));
  $linea_name = $con->real_escape_string(htmlentities($_POST['linea_name']));


  //$ins = $con->query("INSERT equipment VALUES('','$branch','$model_name','$serie_number','$linea_name')");
  $ins = $con->query("INSERT INTO equipment (id_branches, id_model, series_number, id_linea) VALUES ('$branch','$model_name','$serie_number','$linea_name')");
  
  
if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=equipment&p=fuera&t=success&id='.$model_name.'');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar el equipo&c=equipment&p=fuera&t=error&id='.$model_name.'');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
