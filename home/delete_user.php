<?php include '../conn/connn.php';

$id = $con-> real_escape_string(htmlentities($_GET['id']));

$sel_user_type = $con->query("SELECT * FROM users WHERE id='$id' ");

while ($fu = $sel_user_type->fetch_assoc()) {

$user_type = $fu['rol'];
$user_email = $fu['email'];

}

if($user_type == 'ESPECIALISTA'){

  $sel_tech  = $con->query("SELECT * FROM techs WHERE email='$user_email' ");

  $row = mysqli_num_rows($sel_tech);

  if ($row != 0) {
    header('location:../extend/alerta.php?msj=Debes eliminar el usuario desde su perfil de técnico&c=u&p=fuera&t=error');
  }else{
    $eli = $con->query("DELETE FROM users WHERE id='$id' ");
  }

}

if($user_type == 'SUPERVISOR'){

  $sel_tech  = $con->query("SELECT * FROM users WHERE email ='$user_email' ");

  $row = mysqli_num_rows($sel_tech);

 
    $eli = $con->query("DELETE FROM users WHERE id='$id' ");
 

}

if($user_type == 'ADMINISTRADOR'){

  $sel_tech  = $con->query("SELECT * FROM users WHERE email ='$user_email' ");

  $row = mysqli_num_rows($sel_tech);

 
    $eli = $con->query("DELETE FROM users WHERE id='$id' ");
 

}


if ($eli) {
  header('location:../extend/alerta.php?msj=Usuario eliminado&c=u&p=fuera&t=success');
}else {
  header('location:../extend/alerta.php?msj=El usuario no pudo ser eliminado&c=u&p=fuera&t=error');
}

$con->close();

 ?>
