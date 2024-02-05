<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $correo = $con->real_escape_string(htmlentities($_POST['correo']));
  $pass1  = $con->real_escape_string(htmlentities($_POST['pass1']));
  $nivel  = $con->real_escape_string(htmlentities($_POST['nivel']));
  $nombre = $con->real_escape_string(htmlentities($_POST['nombre']));

  if (empty($correo) || empty($nivel) || empty($nombre)) {
    header('location:../extend/alerta.php?msj=Hay un campo sin especificar&c=us&p=in&t=error');
    exit;
  }
  if (!ctype_alpha($nivel)) {
    header('location:../extend/alerta.php?msj=Solo se permiten letras en el campo nivel&c=us&p=in&t=error');
  }

  $contra = strlen($pass1);
  if ($contra < 8 || $contra > 15 ) {
    header('location:../extend/alerta.php?msj=La contraseÃ±a debe contener al menos 8 caracteres&c=us&p=in&t=error');
    exit;
  }

  if (!empty($correo)) {
      if (!filter_var($correo,FILTER_VALIDATE_EMAIL)) {
        header('location:../extend/alerta.php?msj=El correo ingresado no es valido&c=us&p=in&t=error');
        exit;
      }
  }

  $pass1  = sha1($pass1);

  $ins = $con->query("INSERT INTO users (name, password, rol, email) VALUES ('$nombre','$pass1','$nivel','$correo')");

  if ($ins) {
    $user_id = $con->insert_id; // Obtener el ID del usuario reci«±n creado

    if ($nivel == 'ESPECIALISTA') {
      $ins2 = $con->query("INSERT INTO techs (users_id, name, rut, phone, email, hour_price) VALUES ('$user_id', '$nombre','completar','completar','$correo','10000')");
    }

    header('location:../extend/alerta.php?msj=Se ingreso con exito&c=u&p=fuera&t=success');
  } else {
    header('location:../extend/alerta.php?msj=No se pudo ingresar el usuario&c=u&p=fuera&t=error');
  }
  $con->close();
} else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
?>
