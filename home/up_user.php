<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $email = $con->real_escape_string(htmlentities($_POST['email']));
  $name = $con->real_escape_string(htmlentities($_POST['name']));






  $up = $con->query("UPDATE users SET name='$name', email='$email' WHERE id='$id' ");
  $up2 = $con->query("UPDATE techs SET name='$name' WHERE users_id='$id' ");

  if ($up) {
      header('location:../extend/alerta.php?msj=Usuario actualizado&c=us&p=in&t=success');
  }else {
      header('location:../extend/alerta.php?msj=No se pudo actualizar el usuario&c=us&p=in&t=error');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
