<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $name  = $con->real_escape_string(htmlentities($_POST['name']));
  $tiempo  = $con->real_escape_string(htmlentities($_POST['tiempo']));




  //$ins = $con->query("INSERT tasks VALUES('','$id','$name')");
  $ins = $con->query("INSERT INTO tasks (id_service, name, tiempo) VALUES ('$id','$name', '$tiempo')");

  if ($ins) {
    header('location:../extend/alerta.php?msj=Se ingreso con exito&c=service&p=up_service&t=success&id=' . $id . '');
  } else {
    header('location:../extend/alerta.php?msj=No se pudo ingresar el ejecutivo(a)&c=service&p=up_service&t=error&id=' . $id . '');
  }
  $con->close();
} else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
