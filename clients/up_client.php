<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $name = $con->real_escape_string(htmlentities($_POST['name']));
  $email = $con->real_escape_string(htmlentities($_POST['email']));
  $rut = $con->real_escape_string(htmlentities($_POST['rut']));
  $web = $con->real_escape_string(htmlentities($_POST['web']));
  $phone = $con->real_escape_string(htmlentities($_POST['phone']));




  $up = $con->query("UPDATE clients SET name='$name', email='$email', rut='$rut', web='$web', phone='$phone' WHERE id='$id' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Cliente actualizado&c=us&p=in&t=success');
  }else {
      header('location:../extend/alerta.php?msj=No se pudo actualizar el cliente&c=us&p=in&t=error');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
