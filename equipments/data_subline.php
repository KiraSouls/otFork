<?php
include '../conn/connn.php';

$id_subline = $_POST['id_subline'];

$sel2 = $con->query("SELECT DISTINCT name, id, linea_brands.id_relation FROM brands
INNER JOIN linea_brands
ON brands.id = linea_brands.id_brand
WHERE linea_brands.id_line = '$id_subline'");
                     
       $html = "<option value='0' >Selecciona una marca</option>";

        while ($f = $sel2->fetch_assoc()) { 
         
            $html .= "<option value='".$f['id']."'>".$f['name']."</option>";
        } 

        echo $html;
?>