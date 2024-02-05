<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $name  = $con->real_escape_string(htmlentities($_POST['name']));
  $level = $con->real_escape_string(htmlentities($_POST['level']));


  //$ins = $con->query("INSERT areas VALUES('','$name','$id','$level')");
   // $ins = $con->query("INSERT INTO areas () VALUES ('$name','$id','$level')");

if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=tech&p=up_tech&t=success&id='.$id.'');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar el contacto&c=us&p=in&t=error&id='.$id.'');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
