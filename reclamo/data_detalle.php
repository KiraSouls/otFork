<?php
include '../conn/connn.php';

$ot = $_POST['ot'];

$html = "";

//Query para obtener todas las cotizacion
$sel = $con->query("select t.number_ot, ts.name, o.created_at 
    from tasks_equipments t inner join tasks ts on 
    t.id_tasks=ts.id inner join ots o on 
    t.number_ot=o.number where t.number_ot='$ot'");

while($f = $sel->fetch_assoc()){
    $html .= "<tr><td>".$f['number_ot']."</td><td>".$f['name']."</td><td>".$f['created_at']."</td></tr>";
}

echo $html;
?>