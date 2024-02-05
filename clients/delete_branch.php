<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));
$idx = $con-> real_escape_string(htmlentities($_GET['idx']));

$eli = $con->query("DELETE FROM branches WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Sucursal eliminada&c=client&p=clients_update&t=success&id='.$idx.'');
}else {
  header('location:../extend/alerta.php?msj=La sucursal no pudo ser eliminada&c=client&p=clients_update&t=error&id='.$idx.'');
}

$con->close();

 ?>
