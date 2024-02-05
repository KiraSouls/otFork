<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['idEmpresa']));
$eli = $con->query("DELETE FROM empresas WHERE idEmpresa='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=La solicitud se elimino correctamente&c=soli&p=mail&t=success');
}else {
  header('location:../extend/alerta.php?msj=La solicitud no pudo ser eliminado&c=soli&p=mail&t=error');
}

$con->close();

 ?>
