<?php include '../conn/connn.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));

$delete = $con->query("DELETE FROM ejecucion_ot WHERE id='$id' ");

if ($delete) {
    header('location:../extend/alerta.php?msj=Agendamiento eliminada&c=reclamo&p=listReclamo&t=success&id='.$id.'');
}else {
    header('location:../extend/alerta.php?msj=El agendamiento no pudo ser eliminada&c=reclamo&p=listReclamo&t=error&id='.$id.'');
}

$con->close();
?>