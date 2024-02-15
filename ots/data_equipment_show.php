<?php
include '../conn/connn.php';

$id_service = $_POST['id_service'];

$sel2 = $con->query("SELECT *  FROM services WHERE id='$id_service' AND equipment=1");
$imp = $con->query("SELECT *  FROM services WHERE id='$id_service' AND equipment=2");


$row = mysqli_num_rows($sel2);
$row2 = mysqli_num_rows($imp);



if ($row != 0) {

  echo "1";
} elseif ($row == 0 && $row2 != 0) {
  echo "2";
} else {
  echo "0";
}
