<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $nueva_sucursal  = $con->real_escape_string(htmlentities($_POST['branch_location']));
  $phone  = $con->real_escape_string(htmlentities($_POST['branch_phone']));
  $name  = $con->real_escape_string(htmlentities($_POST['branch_name']));



  //$ins = $con->query("INSERT branches VALUES('','$id','$nueva_sucursal','$phone','$name')");
  $ins = $con->query("INSERT INTO branches (id_clients, location, phone, branch_name) VALUES ('$id','$nueva_sucursal','$phone','$name')");

if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=client&p=clients_update&t=success&id='.$id.'');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar la sucursal&c=client&p=clients_update&t=error&id='.$id.'');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
