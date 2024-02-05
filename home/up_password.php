<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $password = $con->real_escape_string(htmlentities($_POST['pass1']));

  $password  = sha1($password);





  $up = $con->query("UPDATE users SET password='$password' WHERE id='$id' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Contraseña actualizada&c=us&p=in&t=success');
  }else {
      header('location:../extend/alerta.php?msj=No se pudo actualizar el usuario&c=us&p=in&t=error');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
