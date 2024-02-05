<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $name = $con->real_escape_string(htmlentities($_POST['model_name']));
  $pal_number = $con->real_escape_string(htmlentities($_POST['pal_number']));
  $short_desc = $con->real_escape_string(htmlentities($_POST['short_desc']));
  $long_desc = $con->real_escape_string(htmlentities($_POST['long_desc']));

  $idx = $con->real_escape_string(htmlentities($_POST['id']));
    $id = $con->real_escape_string(htmlentities($_POST['idx']));




  $up = $con->query("UPDATE model SET name='$name', pal_number='$pal_number', short_desc='$short_desc', long_desc='$long_desc' WHERE id='$idx' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Modelo actualizado&c=equipment&p=update_model&t=success&id='.$idx.'');
  }else {
      header('location:../extend/alerta.php?msj=No se pudo actualizar el modelo&c=equipment&p=update_model&t=error&id='.$idx.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error');

}
