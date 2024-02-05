<?php include '../conn/connn.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));

$sel = $con->query("select * from contrato where id='$id'");
while ($f = $sel->fetch_assoc()) {
    $location = $f['location'];
}

unlink($location);
$delete = $con->query("DELETE FROM contrato WHERE id='$id'");

if ($delete) {
    header('location:../extend/alerta.php?msj=Contrato Eliminado eliminada&c=reclamo&p=listReclamo&t=success&id='.$id.'');
}else {
    header('location:../extend/alerta.php?msj=El Contrato no pudo ser eliminada&c=reclamo&p=listReclamo&t=error&id='.$id.'');
}

$con->close();
?>