<?php
include '../conn/connn.php';


$correo = $con->real_escape_string($_POST['correo']);

$sel = $con->query("SELECT id FROM users WHERE email = '$correo' ");
$row = mysqli_num_rows($sel);
if ($row != 0) {
  echo "<label style='color:red;'>Este correo ya esta en uso</label>";
}else{
echo "<label style='color:green;'>Correo disponible</label>";
}
$con->close();
?>
