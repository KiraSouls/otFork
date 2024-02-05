<?php
include '../conn/connn.php';

$id_client = $_POST['id_client'];

$sel2 = $con->query("SELECT * FROM branches WHERE id_clients='$id_client'");
                     
       $html = "<option value='0' >Selecciona una sucursal</option>";

        while ($f = $sel2->fetch_assoc()) { 
         
            $html .= "<option value='".$f['id']."'>".$f['branch_name']."-".$f['location']."</option>";
        } 

        echo $html;
?>