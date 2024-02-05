<?php
include '../conn/connn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $jeje = $_SESSION['correo'];
  $pass = $con->real_escape_string(htmlentities($_POST['pass']));
  $pass=sha1($pass);

  $up = $con->query("UPDATE usuarios SET contrasena='$pass' WHERE correo='$jeje' ");

  if ($up) {

    header('location:../extend/alerta.php?msj=Password actualizada&c=perfil&p=perfil&t=success');
  }
  else {
        header('location:../extend/alerta.php?msj=No se pudo actualizar la password&c=perfil&p=perfil&t=error');
  }
}
else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}

 ?>
