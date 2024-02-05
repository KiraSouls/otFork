<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));
$id_provider = $con-> real_escape_string(htmlentities($_GET['id_provider']));


$eli = $con->query("DELETE FROM executives WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Ejecutivo(a) eliminado&c=provider&p=up_provider&t=success&id='.$id_provider.'');
}else {
  header('location:../extend/alerta.php?msj=El executivo(a) no pudo ser eliminada&c=provider&p=up_provider&t=error&id='.$id_provider.'');
}

$con->close();

 ?>
