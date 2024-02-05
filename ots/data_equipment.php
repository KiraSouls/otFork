<?php
include '../conn/connn.php';

$id_branches = $_POST['id_branch'];

$sel2 = $con->query("SELECT * FROM equipment WHERE id_branches='$id_branches'");

       $html = "<option value='0' >Selecciona un equipo</option>";

        while ($f = $sel2->fetch_assoc()) {

            $html .= "<option value='".$f['id']."'>".$f['equipment_name']."</option>";
        }

        echo $html;
?>
