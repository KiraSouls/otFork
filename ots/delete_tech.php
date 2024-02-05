<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));

$eli = $con->query("DELETE FROM techs WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Especialista eliminado&c=tech&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=El contacto no pudo ser eliminada&c=tech&p=fuera&t=error');
}

$con->close();

 ?>
