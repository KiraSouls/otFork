<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));

$eli = $con->query("DELETE FROM providers WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Proveedor eliminado&c=provider&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=El proveedor no pudo ser eliminada&c=provider&p=fuera&t=error');
}

$con->close();

 ?>
