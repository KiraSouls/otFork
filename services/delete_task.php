<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));
$idx = $con-> real_escape_string(htmlentities($_GET['idx']));


$eli = $con->query("DELETE FROM tasks WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Tarea eliminada&c=service&p=up_service&t=success&id='.$idx.'');
}else {
  header('location:../extend/alerta.php?msj=La tarea no pudo ser eliminada&c=service&p=up_service&t=error&id='.$idx.'');
}

$con->close();

 ?>
