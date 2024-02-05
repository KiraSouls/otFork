<?php
include '../conn/connn.php';
$password = $con->real_escape_string($_POST['passwword']);
$correo = htmlentities($_GET['co']);

$up = $con->query("UPDATE usuarios SET contrasena='$password' WHERE correo='$correo'");

if ($up) {
    header('location:../extend/alerta.php?msj=Su contraseña fue cambiada con éxito&c=donde&p=mail&t=success');
}else {
    header('location:../extend/alerta.php?msj=Error al cambiar su contraseña&c=donde&p=mail&t=error');
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FIKA COFFEE SHOP</title>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet" type="text/css">
    <link href="css2/bootstrap.min.css" rel="stylesheet">
    <link href="css2/style3.css" rel="stylesheet">
    <link href="img/small.ico" rel="icon">
  </head>

  <body >

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="js2/bootstrap.min.js"></script>
  </body>
</html>
