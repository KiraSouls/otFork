<?php
include '../conn/connn.php';

$id_client = $_POST['id_client'];
$periodo_año = date('Y');
$periodo_mes = date('m');

$sel2 = $con->query("SELECT count(*) FROM ots where MONTH(created_at) = $periodo_mes and YEAR(created_at) = $periodo_año and tipo_visitas = 'Soporte Tecnico'
and id_client= '$id_client'");

while ($f = $sel2->fetch_assoc()) {

    $html .= "<option value='" . $f['count(*)'] . "'>" . $f['count(*)'] . "</option>";
}

echo $html;
