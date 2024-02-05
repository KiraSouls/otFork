<?php
include '../conn/connn.php';

$id_linea = $_POST['id_linea'];

$sel2 = $con->query("SELECT * FROM sub_linea
WHERE id_line = '$id_linea'");
                     
       $html = "<option value='0' >Selecciona una Sub linea</option>";

        while ($f = $sel2->fetch_assoc()) { 
         
            $html .= "<option value='".$f['id']."'>".$f['name']."</option>";
        } 

        echo $html;
?>