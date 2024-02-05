<?php
 include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


header('Content-type: application/vnd.ms-excel; name="excel"');
header('Content-Disposition: filename=Reporte.xls');
header('Pragma: no-cache');
header('Expires: 0');

echo $_POST['datos'];

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}

 ?>
