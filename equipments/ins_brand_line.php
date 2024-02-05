<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id_subline  = $con->real_escape_string(htmlentities($_POST['id_subline']));
  $id_line  = $con->real_escape_string(htmlentities($_POST['id_line']));
  $brand= $_POST['brand'];

  foreach($brand as $val){
    //$ins = $con->query("INSERT linea_brands VALUES('','$val','$id_subline')");
    $ins = $con->query("INSERT INTO linea_brands (id_brand, id_line) VALUES ('$val','$id_subline')");

  }

if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=equipment&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=No se pudo asociar marca&c=equipment&p=fuera&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
