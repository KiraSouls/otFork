<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));
$idx = $con-> real_escape_string(htmlentities($_GET['idx']));


$eli = $con->query("DELETE FROM activities WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Actividad eliminada&c=ots&p=update_ot&t=success&id='.$idx.'');
}else {
  header('location:../extend/alerta.php?msj=La actividad no pudo ser eliminada&c=ots&p=update_ot&t=error&id='.$idx.'');
}

$con->close();



do{

}while (in_array($rr['id_tasks'], $p));


if (in_array($rr['id_tasks'], $p)) {

}
 ?>
