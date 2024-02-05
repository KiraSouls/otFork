<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id_linea  = $con->real_escape_string(htmlentities($_POST['id_linea']));
  $name  = $con->real_escape_string(htmlentities($_POST['subline_name']));


  //$ins = $con->query("INSERT sub_linea VALUES('','$name','$id_linea')");
    $ins = $con->query("INSERT INTO sub_linea (name, id_line) VALUES ('$name','$id_linea')");

if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=equipment&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar la linea&c=equipment&p=fuera&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
