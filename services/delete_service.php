<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));


$eli = $con->query("DELETE FROM services WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Servicio eliminado&c=service&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=El servicio no pudo ser eliminada&c=service&p=fuera&t=error');
}

$con->close();

 ?>
