<?php include '../conn/connn.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));

$eli = $con->query("DELETE FROM detalle_convenio WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Detalle eliminado&c=cnv&p=r&t=success');
} else {
  header('location:../extend/alerta.php?msj=El detalle no pudo ser eliminado&c=cnv&p=r&t=error');
}

$con->close();
