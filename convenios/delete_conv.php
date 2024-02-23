<?php include '../conn/connn.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));

$eli = $con->query("DELETE FROM convenios WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Convenio eliminado&c=cnv&p=r&t=success');
} else {
  header('location:../extend/alerta.php?msj=El Convenio no pudo ser eliminado&c=cnv&p=r&t=error');
}

$con->close();
