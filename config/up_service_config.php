<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $sub_linea = $con->real_escape_string(htmlentities($_POST['sub_linea']));
  $service = $con->real_escape_string(htmlentities($_POST['service']));



  $up = $con->query("UPDATE services SET id_sublinea='$sub_linea' WHERE id='$service' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Servicio actualizado&c=config&p=fuera&t=success&id='.$id.'');
  }else {
      header('location:../extend/alerta.php?msj=El servicio no se pudo actualizar&c=config&p=fuera&t=error&id='.$id.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
