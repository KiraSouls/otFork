<?php
include '../conn/connn.php';

$id_client = $_POST['id_client'];
$id_branch = $_POST['id_branch'];
$id_service = $_POST['id_service'];
$periodo_año = date('Y');
$periodo_mes = date('m');
$val = null;
$error = "error";

$validador = $sel = $con->query("SELECT * FROM convenios where id_cliente = '$id_client' and id_branch = '$id_branch' and estado = 'Vigente'");
$row = mysqli_num_rows($validador);

if ($row == '1') {
    $sel = $con->query("
    SELECT c.id, c.horas_tecnicas, c.estado, c.created_at,
    br.id_servicio
    FROM  convenios c
    inner join detalle_convenio br on c.id = br.num_convenio
    where id_servicio = $id_service and estado = 'Vigente'
    
    ");
    while ($f = $sel->fetch_assoc()) {
        $val = $f['horas_tecnicas'];
    }

    // $sel = $con->query("SELECT * FROM convenios where id_cliente = '$id_client' and id_branch = '$id_branch' and estado = 'Vigente'");
    // while ($f = $sel->fetch_assoc()) {
    //     $val = $f['horas_tecnicas'];
    // }

    $sel2 = $con->query("SELECT count(*) FROM ots where MONTH(created_at) = $periodo_mes and YEAR(created_at) = $periodo_año and tipo_visitas = 'Horas Tecnicas'
    and id_client= '$id_client' and id_branch= '$id_branch'");

    while ($f = $sel2->fetch_assoc()) {

        $count = $f['count(*)'];
    }
    if ($val > 0) {
        $sum = $val - $count;
    } else {
        $sum = "cotizar";
    }
    echo $sum;
} else {
    echo $error;
}
