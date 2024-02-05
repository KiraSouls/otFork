<?php
include '../conn/connn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $jeje = $_SESSION['correo'];
  $correo = $con->real_escape_string(htmlentities($_POST['correo']));
  $nombre = $con->real_escape_string(htmlentities($_POST['nombre']));
  $bebida = $con->real_escape_string(htmlentities($_POST['bebida']));
  $pastel = $con->real_escape_string(htmlentities($_POST['pastel']));

  if (empty($correo) || empty($nombre) || $bebida == Ninguna  || $pastel== Ninguno ) {
    header('location:../extend/alerta.php?msj=Por favor no deje campos vacios&c=us&p=in&t=error');
    exit;
  }

  $up = $con->query("UPDATE usuarios SET nombre='$nombre', correo='$correo', bebida='$bebida', pastel='$pastel' WHERE correo='$jeje' ");

  if ($up) {
    $_SESSION['correo'] = $correo;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['pastel'] = $pastel;
    $_SESSION['bebida'] = $bebida;

    header('location:../extend/alerta.php?msj=Datos actualizados&c=salir&p=datoscon&t=success');
  }
  else {
        header('location:../extend/alerta.php?msj=Datos actualizados&c=salir&p=datosconb&t=error');
  }
}
else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=salir&p=fuera&t=error');
}
 ?>
