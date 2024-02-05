<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));


$eli = $con->query("DELETE FROM brands WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Marca eliminada&c=equipment&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=La marca no pudo ser eliminada&c=equipment&p=fuera&t=error');
}

$con->close();

 ?>
