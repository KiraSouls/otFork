<?php
include '../conn/connn.php';

$id_sublinea = $_POST['id_sublinea'];
$id_brand = $_POST['id_brand'];


$sel2 = $con->query("SELECT * FROM model WHERE id_sublinea='$id_sublinea' AND id_brand='$id_brand' ");

       $html = "<option value='0' >Selecciona un modelo</option>";

        while ($f = $sel2->fetch_assoc()) {

            $html .= "<option value='".$f['id']."'>".$f['name']."</option>";
        }

        echo $html;
?>
