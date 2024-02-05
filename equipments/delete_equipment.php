<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));
$idx = $con-> real_escape_string(htmlentities($_GET['idx']));


$eli = $con->query("DELETE FROM equipment WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Equipo eliminado&c=equipment&p=fuera&t=success&id='.$idx.'');
}else {
  header('location:../extend/alerta.php?msj=El equipo no pudo ser eliminado&c=equipment&p=fuera&t=error');
}

$con->close();

 ?>
