<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));


$eli = $con->query("DELETE FROM parameter_area WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Área eliminada&c=tech&p=parameter_area&t=success&id='.$id.'');
}else {
  header('location:../extend/alerta.php?msj=La área no pudo ser eliminada&c=tech&p=parameter_area&t=error&id='.$id.'');
}

$con->close();

 ?>
