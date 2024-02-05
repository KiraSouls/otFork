<?php
include '../conn/connn.php';


$correo = $con->real_escape_string($_POST['correo']);

$sel = $con->query("SELECT idusuario FROM usuarios WHERE correo = '$correo' ");
$row = mysqli_num_rows($sel);
if ($row != 0) {
  echo "<label  style='color:red;'>   </label>";
}else{
echo "<label   style='color:red;'>Esta cuenta no existe</label>";
}
$con->close();
?>
