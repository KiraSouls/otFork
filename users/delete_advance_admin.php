<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));

$eli = $con->query("DELETE FROM advances WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Avance eliminado&c=ots&p=mail&t=success');
}else {
  header('location:../extend/alerta.php?msj=El avance no pudo ser eliminado&c=ots&p=mail&t=error');
}

$con->close();

 ?>
