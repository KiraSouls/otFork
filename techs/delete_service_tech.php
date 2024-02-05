<?php include '../conn/connn.php';

$id_relation = $con-> real_escape_string(htmlentities($_GET['id_relation']));
$id_tech = $con-> real_escape_string(htmlentities($_GET['id_tech']));



$eli = $con->query("DELETE  FROM techs_services WHERE id_relation='$id_relation'");

if ($eli) {
  header('location:../extend/alerta.php?msj=Servicio eliminado&c=tech&p=up_tech&t=success&id='.$id_tech.'');
}else {
  header('location:../extend/alerta.php?msj=El servicio no pudo ser eliminada&c=tech&p=up_tech&t=error&id='.$id_tech.'');
}

$con->close();

 ?>
