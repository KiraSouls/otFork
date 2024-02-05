<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $name = $con->real_escape_string(htmlentities($_POST['contact_name']));
  $email = $con->real_escape_string(htmlentities($_POST['contact_email']));
  $department = $con->real_escape_string(htmlentities($_POST['contact_department']));
  $charge = $con->real_escape_string(htmlentities($_POST['contact_charge']));
  $phone = $con->real_escape_string(htmlentities($_POST['contact_phone']));




  $up = $con->query("UPDATE contacts SET contact_name='$name', email='$email', department='$department', charge='$charge', phone='$phone' WHERE id='$id' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Contacto actualizado&c=us&p=in&t=success');
  }else {
      header('location:../extend/alerta.php?msj=No se pudo actualizar el contacto&c=us&p=in&t=error');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
