<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));


$eli = $con->query("DELETE FROM replacements WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Repuesto eliminado&c=replacement&p=fuera&t=success&id='.$id.'');
}else {
  header('location:../extend/alerta.php?msj=La repuesto no pudo ser eliminada&c=replacement&p=fuera&t=error&id='.$id.'');
}

$con->close();

 ?>
