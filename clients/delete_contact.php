<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));
$idx = $con-> real_escape_string(htmlentities($_GET['idx']));


$eli = $con->query("DELETE FROM contacts WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Contacto eliminado&c=client&p=ins_branch&t=success&id='.$idx.'');
}else {
  header('location:../extend/alerta.php?msj=El contacto no pudo ser eliminada&c=client&p=ins_branch&t=error&id='.$idx.'');
}

$con->close();

 ?>
