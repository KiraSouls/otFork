<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id_equipment = $con->real_escape_string(htmlentities($_POST['id_equipment']));
  $branch = $con->real_escape_string(htmlentities($_POST['branch']));
  $brand_name = $con->real_escape_string(htmlentities($_POST['brand_name']));
  $model_name = $con->real_escape_string(htmlentities($_POST['model_name']));
  $equipment_name = $con->real_escape_string(htmlentities($_POST['equipment_name']));
  $serie_number = $con->real_escape_string(htmlentities($_POST['serie_number']));
  $pal_number = $con->real_escape_string(htmlentities($_POST['pal_number']));
  $id_linea = $con->real_escape_string(htmlentities($_POST['id_linea']));





  $up = $con->query("UPDATE equipment SET id_branches='$branch',  id_model='$model_name', series_number='$serie_number' WHERE id='$id_equipment' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Equipo actualizado&c=equipment&p=fuera&t=success&id='.$model_name.'');
  }else {
      header('location:../extend/alerta.php?msj=El equipo no se pudo actualizar&c=equipment&p=fueral&t=error&id='.$model_name.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
