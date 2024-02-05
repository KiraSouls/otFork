<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));



$eli = $con->query("DELETE FROM linea WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Linea eliminado&c=equipment&p=fuera&t=success&id='.$idx.'');
}else {
  header('location:../extend/alerta.php?msj=La linea no pudo ser eliminada&c=equipment&p=fuera&t=error');
}

$con->close();

 ?>
