<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['idusuario']));
echo $id;
$eli = $con->query("DELETE FROM usuarios WHERE idusuario='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Usuario eliminado&c=us&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=El usuario no pudo ser eliminado&c=us&p=in&t=error');
}

$con->close();

 ?>
