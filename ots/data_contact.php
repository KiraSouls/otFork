<?php
include '../conn/connn.php';

$id_branch = $_POST['id_branch'];

$sel3 = $con->query("SELECT * FROM contacts WHERE id_branches='$id_branch'");
                     
       $html = "<option value='0' selected>Selecciona un contacto</option>";

        while ($g = $sel3->fetch_assoc()) { 
         
            $html .= "<option value='".$g['id']."'selected>".$g['contact_name']."</option>";
        } 

        echo $html;
?>