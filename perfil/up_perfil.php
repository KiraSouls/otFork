<?php
include '../conn/connn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $jeje = $_SESSION['correo'];
  $correo = $con->real_escape_string(htmlentities($_POST['correo']));
  $nombre = $con->real_escape_string(htmlentities($_POST['nombre']));

  $up = $con->query("UPDATE usuarios SET nombre='$nombre', correo='$correo' WHERE correo='$jeje' ");

  if ($up) {
    $_SESSION['correo'] = $correo;
    $_SESSION['nombre'] = $nombre;
    header('location:../extend/alerta.php?msj=Datos actualizados&c=perfil&p=perfil&t=success');
  }
  else {
        header('location:../extend/alerta.php?msj=Datos actualizados&c=perfil&p=perfil&t=error');
  }
}
else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
