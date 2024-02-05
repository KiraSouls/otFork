<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));


$eli = $con->query("DELETE FROM areas WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Área eliminada&c=tech&p=fuera&t=success&id='.$id.'');
}else {
  header('location:../extend/alerta.php?msj=La área no pudo ser eliminada&c=tech&p=fuera&t=error&id='.$id.'');
}

$con->close();

 ?>
