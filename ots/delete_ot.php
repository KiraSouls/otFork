<?php include '../conn/connn.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));

$eli2 = $con->query("SELECT number FROM ots WHERE id=$id");
while($f = $eli2->fetch_assoc()){
  $number_ot = $f['number'];
  $eli3 = $con->query("DELETE FROM tasks_equipments WHERE number_ot = '$number_ot' ");
  $eli5 = $con->query("DELETE FROM participants WHERE ot_number = '$number_ot' ");

}

$eli = $con->query("DELETE FROM ots WHERE id='$id' ");

if ($eli) {
  header('location:../extend/alerta.php?msj=Orden eliminada&c=ots&p=fuera&t=success&id='.$id.'');
}else {
  header('location:../extend/alerta.php?msj=La orden no pudo ser eliminada&c=ots&p=fuera&t=error&id='.$id.'');
}

$con->close();

 ?>
