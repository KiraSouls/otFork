<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $name  = $con->real_escape_string(htmlentities($_POST['name']));




  $up = $con->query("UPDATE services SET service_name='$name'  WHERE id='$id' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Servicio actualizado&c=service&p=fuera&t=success&id='.$id.'');
  }else {
      header('location:../extend/alerta.php?msj=El servicio no se pudo actualizar&c=service&p=fuera&t=error&id='.$id.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
