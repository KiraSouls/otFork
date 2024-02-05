<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $email = $con->real_escape_string(htmlentities($_POST['email']));
  $name  = $con->real_escape_string(htmlentities($_POST['name']));
  $hour_price = $con->real_escape_string(htmlentities($_POST['hour_price']));
  $rut = $con->real_escape_string(htmlentities($_POST['rut']));
  $phone = $con->real_escape_string(htmlentities($_POST['phone']));
  $users_id = $con->real_escape_string(htmlentities($_POST['users_id']));


  $up = $con->query("UPDATE techs SET email='$email', phone='$phone', name='$name', hour_price='$hour_price', rut='$rut' WHERE id='$id' ");
  
  
  
  // Get the users_id from the techs table and save it in the variable $users_id
  $users_id_result = $con->query("SELECT users_id FROM techs WHERE id='$id'");
  $users_id = ($users_id_result && $users_id_result->num_rows > 0) ? $users_id_result->fetch_assoc()['users_id'] : null;
  
  
  // Update the users table only if $users_id is not null
  if ($users_id !== null) {
    $up2 = $con->query("UPDATE users SET name='$name' WHERE id='$users_id' ");
  }


  if ($up) {
      header('location:../extend/alerta.php?msj=Especialista actualizado&c=tech&p=up_tech&t=success&id='.$id.'');
  }else {
      header('location:../extend/alerta.php?msj=El especialista no se pudo actualizar&c=tech&p=up_tech&t=error&id='.$id.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
