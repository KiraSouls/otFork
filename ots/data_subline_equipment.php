<?php
include '../conn/connn.php';

$id_subline = $_POST['id_subline'];
$id_branch = $_POST['id_branch'];

$sel2 = $con->query("SELECT * FROM equipment WHERE id_linea='$id_subline' and id_branches='$id_branch'");

       $html = "<option value='0' >Selecciona un equipo</option>";

       
        while ($f = $sel2->fetch_assoc()) {
            $id_equipment=$f['id'];
            $sel_model_name = $con->query("SELECT a.id_model, b.name as model_name
                                           FROM equipment as a
                                           JOIN model as b
                                           ON a.id_model=b.id
                                           WHERE a.id = '$id_equipment'");
            while ($t = $sel_model_name->fetch_assoc()) {
                $model_name = $t['model_name'];
            }

            $html .= "<option value='".$f['id']."'>Modelo: ".$model_name." Nº serie: ".$f['series_number']."</option>";
        }

        echo $html;
?>
