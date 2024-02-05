<?php
include '../conn/connn.php';


$correo = $con->real_escape_string($_POST['correo']);

$correo_tech = $con->real_escape_string($_POST['email']);

$sel = $con->query("SELECT * FROM usuarios WHERE correo = '$correo' ");
$row = mysqli_num_rows($sel);


$sel_email_tech = $con->query("SELECT * FROM techs WHERE email = '$correo_tech' ");
$row_tech = mysqli_num_rows($sel_email_tech);


if ($row != 0 or $row_tech != 0){
  echo "<label style='color:red;'>Este correo ya esta en uso</label>";
}else{
echo "<label style='color:green;'>Correo disponible</label>";
}
$con->close();
?>
