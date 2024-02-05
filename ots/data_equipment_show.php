<?php
include '../conn/connn.php';

$id_service = $_POST['id_service'];

$sel2 = $con->query("SELECT *  FROM services WHERE id='$id_service' AND equipment=1");

$row = mysqli_num_rows($sel2);

          if ($row != 0) {
            echo "1";
          }else{
          echo "0";
          }




?>
