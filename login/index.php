<?php include '../conn/connn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = $con->real_escape_string(htmlentities($_POST['email']));
  $pass = $con->real_escape_string(htmlentities($_POST['password']));
  $candado = ' ';
  $str_u = strpos($user, $candado);
  $str_u = strpos($pass, $candado);

  if (is_int($str_u)) {
    $user = '';
  } else {
    $usuario = $user;
  }

  if (is_int($str_p)) {
    $pass = '';
  } else {
    $pass2 = sha1($pass);
  }

  if ($user == null && $pass == null) {
    header('location:../extend/alerta.php?msj=El formato no es correcto&c=normal&p=login&t=error');
  } else {

    $sel = $con->query("SELECT email, name, rol, password, id  FROM users WHERE email = '$usuario' AND password = '$pass2' ");
    $row = mysqli_num_rows($sel);
    if ($row == 1) {
      if ($var = $sel->fetch_assoc()) {
        $correo = $var['email'];
        $nombre = $var['name'];
        $password = $var['password'];
        $id = $var['id'];
        $rol = $var['rol'];
      }

      if ($correo == $usuario && $password == $pass2 && $rol == 'ADMINISTRADOR') {
        $_SESSION['email'] = $correo;
        $_SESSION['name'] = $nombre;
        $_SESSION['rol'] = $rol;
        $_SESSION['id'] = $id;
        header('location:../extend/alerta.php?msj=Bienvenido&c=home&p=home&t=success');
      } elseif ($correo == $usuario && $password == $pass2 && $rol == 'ESPECIALISTA') {
        $_SESSION['email'] = $correo;
        $_SESSION['name'] = $nombre;
        $_SESSION['rol'] = $rol;
        $_SESSION['id'] = $id;
        header('location:../extend/alerta.php?msj=Bienvenido&c=us&p=cashier&t=success');
      } elseif ($correo == $usuario && $contra == $pass2 && $rol == 'USER') {
        $_SESSION['email'] = $correo;
        $_SESSION['name'] = $nombre;
        $_SESSION['id'] = $id;
        header('location:../extend/alerta.php?msj=Bienvenido&c=us&p=cashier&t=success');

        //      header('location:../extend/alerta.php?msj=Bienvenido&c=home&p=cashier&t=success');

        //   header('location:../clubFIKACONVENIO.php');
      } else {
        header('location:../extend/alerta.php?msj=Datos incorrectos&c=normal&p=fuera&t=error');
      }
    } else {
      header('location:../extend/alerta.php?msj=Datos incorrectos&c=normal&p=fuera&t=error');
    }
  }
} else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=salir&p=salir&t=error');
}
