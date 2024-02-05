<?php
include '../conn/connn.php';

$id_service = $_POST['id_service'];

$sel2 = $con->query("SELECT DISTINCT tech.name, tech.id
                            FROM  services ser
                            INNER JOIN techs_services ts ON ts.id_service= '$id_service'
                            INNER JOIN techs tech ON tech.id= ts.id_tech");


        while ($f = $sel2->fetch_assoc()) {

            $html .= "<option value='".$f['name']."'>".$f['name']."</option>";
        }

        echo $html;
?>
