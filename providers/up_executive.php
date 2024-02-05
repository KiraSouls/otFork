<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['idx']));
  $email = $con->real_escape_string(htmlentities($_POST['email']));
  $name  = $con->real_escape_string(htmlentities($_POST['name']));
  $phone = $con->real_escape_string(htmlentities($_POST['phone']));
  $id_provider = $con->real_escape_string(htmlentities($_POST['id_provider']));


  $up = $con->query("UPDATE executives SET email='$email', phone='$phone', name='$name'  WHERE id='$id' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Ejecutivo(a) actualizado&c=provider&p=up_provider&t=success&id='.$id_provider.'');
  }else{
      header('location:../extend/alerta.php?msj=El ejecutivo(a) no se pudo actualizar&c=provider&p=up_provider&t=error&id='.$id_provider.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
