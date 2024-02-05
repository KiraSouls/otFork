<?php
include '../conn/connn.php';

$id_service = $_POST['id_service'];
$id_branches = $_POST['id_branch'];

$sel_subline = $con->query("SELECT id_sublinea FROM services WHERE id='$id_service'");


while ($fu = $sel_subline->fetch_assoc()) {

    $service_line = $fu['id_sublinea'];
}


$sel_id_line = $con->query("SELECT id_line FROM sub_linea WHERE id='$service_line'");

while ($g = $sel_id_line->fetch_assoc()) {

    $id_line = $g['id_line'];
}


       $html = "<option value='0' >Selecciona una sub linea</option>";


            $sel_sublinea = $con->query("SELECT * FROM sub_linea WHERE id_line='$id_line'");
                
                while ($fo = $sel_sublinea->fetch_assoc()) {
                    

                    $html .= "<option value='".$fo['id']."'>".$fo['name']."</option>";
                    

                }
                echo $html;
        

        
?>
