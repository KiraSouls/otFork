<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['idEmpresa']));
$eli = $con->query("DELETE FROM solicitudesestudiantes WHERE idEstudiante='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=La reserva se elimino correctamente&c=soli&p=mail&t=success');
}else {
  header('location:../extend/alerta.php?msj=La reserva no pudo ser eliminado&c=soli&p=mail&t=error');
}

$con->close();

 ?>
