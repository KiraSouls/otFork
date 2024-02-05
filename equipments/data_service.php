<?php
include '../conn/connn.php';

$id_service = $_POST['id_service'];

$sel2 = $con->query("SELECT * FROM tasks WHERE id_service='$id_service'");
                     
       $html = "<option value='0' >Selecciona una tarea</option>";

        while ($f = $sel2->fetch_assoc()) { 
         
            $html .= "<option value='".$f['id']."'>".$f['name']."</option>";
        } 

        echo $html;
?>