<?php
include '../conn/connn.php';

$id_service = $_POST['id_service'];

$sel2 = $con->query("SELECT * FROM services WHERE id='$id_service'");

       $html = "<label for='type'>Requiere equipo</label>";

        while ($f = $sel2->fetch_assoc()) {

            if ($f['equipment'] == 1) {
                $html .= "<p> <input id = 'true' type = 'radio' name = 'equipo' value = '1' checked /> <label for = 'true'>si</label> </p> <p> <input id = 'false' type = 'radio' name = 'equipo' value = '0' /> <label for = 'false'>no</label> </p>";
            }else{
                $html .= "<p> <input id = 'true' type = 'radio' name = 'equipo' value = '1'  /> <label for = 'true'>si</label> </p> <p> <input id = 'false' type = 'radio' name = 'equipo' value = '0' checked /> <label for = 'false'>no</label> </p>";
            }
        }

        echo $html;
?>
