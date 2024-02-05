<?php include '../conn/connn.php';

$id_relation = $con-> real_escape_string(htmlentities($_GET['id_relation']));
$id_brand = $con-> real_escape_string(htmlentities($_GET['id']));



$eli = $con->query("DELETE  FROM linea_brands WHERE id_relation='$id_relation'");

if ($eli) {
  header('location:../extend/alerta.php?msj=Marca eliminada&c=equipment&p=update_line&t=success&id='.$id_brand.'');
}else {
  header('location:../extend/alerta.php?msj=El servicio no pudo ser eliminada&c=equipment&p=update_line&t=error&id='.$id_brand.'');
}

$con->close();

 ?>
