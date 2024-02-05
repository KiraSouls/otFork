<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $email = $con->real_escape_string(htmlentities($_POST['email']));
  $name  = $con->real_escape_string(htmlentities($_POST['name']));
  $location = $con->real_escape_string(htmlentities($_POST['location']));
  $phone = $con->real_escape_string(htmlentities($_POST['phone']));
  $rut = $con->real_escape_string(htmlentities($_POST['rut']));



  $up = $con->query("UPDATE providers SET email='$email', phone='$phone', name='$name', location='$location', rut='$rut' WHERE id='$id' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Proveedor actualizado&c=provider&p=fuera&t=success&id='.$id.'');
  }else {
      header('location:../extend/alerta.php?msj=El proveedor no se pudo actualizar&c=provider&p=fuera&t=error&id='.$id.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
