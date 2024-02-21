<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));

$eli = $con->query("DELETE FROM clients WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Cliente eliminado&c=us&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=El cliente no pudo ser eliminado&c=us&p=in&t=error');
}

$con->close();

 ?>
