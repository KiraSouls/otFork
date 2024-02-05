<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $location = $con->real_escape_string(htmlentities($_POST['location']));
  $name = $con->real_escape_string(htmlentities($_POST['name']));
  $phone = $con->real_escape_string(htmlentities($_POST['phone']));


  $up = $con->query("UPDATE branches SET location='$location', phone='$phone', branch_name='$name' WHERE id='$id' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Sucursal actualizada&c=us&p=in&t=success');
  }else {
      header('location:../extend/alerta.php?msj=No se pudo actualizar la sucursal&c=us&p=in&t=error');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
