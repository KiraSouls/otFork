<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['service']));
  $equipo = $con->real_escape_string(htmlentities($_POST['equipo']));



  $up = $con->query("UPDATE services SET equipment='$equipo' WHERE id='$id' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Ahora este servicio requiere equipos&c=config&p=fuera&t=success&id='.$id.'');
  }else {
      header('location:../extend/alerta.php?msj=El servicio no se pudo actualizar&c=config&p=fuera&t=error&id='.$id.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
