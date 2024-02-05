<?php
include '../conn/connn.php';

$id_service = $_POST['id_service'];
$id_branches = $_POST['id_branch'];

$sel_subline = $con->query("SELECT id_sublinea FROM services WHERE id='$id_service'");


while ($fu = $sel_subline->fetch_assoc()) {

    $service_line = $fu['id_sublinea'];
}


$sel_id_line = $con->query("SELECT id_line FROM sub_linea WHERE id='$service_line'");





$sel2 = $con->query("SELECT * FROM equipment WHERE id_branches='$id_branches' AND id_linea='$service_line'");

       $html = "<option value='0' >Selecciona un equipo</option>";

        while ($f = $sel2->fetch_assoc()) {

            $id_equipo = $f['id'];

            $sel_id_model = $con->query("SELECT id_model FROM equipment WHERE id='$id_equipo'");
                
                while ($fo = $sel_id_model->fetch_assoc()) {
                    $id_model =   $fo['id_model'];

                    $sel_model_name = $con->query("SELECT name FROM model WHERE id='$id_model'");
                        while ($fx = $sel_model_name->fetch_assoc()) {
                            $model_name = $fx['name'];
                        }
                }

            $html .= "<option value='".$f['id']."'> Modelo: ".$model_name." <br> Nº de serie: ".$f['series_number']."</option>";
        }

        echo $html;
?>
