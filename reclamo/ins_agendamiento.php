<?php
include '../conn/connn.php';
require '../filtro/vendor/autoload.php';
// contains a variable called: $API_KEY that is the API Key.
// You need this API_KEY created on the Sendgrid website.
include_once('../filtro/credentials.php');

date_default_timezone_set("America/Santiago");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ot  = $con->real_escape_string(htmlentities($_POST['ot']));
    $dia = $con->real_escape_string(htmlentities($_POST['dia']));
    $hora = $con->real_escape_string(htmlentities($_POST['hora']));      
    $number = $_POST['number'];
    
    //Obtener id Usuario
    $sel = $con->query("select * from ejecucion_ot where ot='$ot'");
    $row = mysqli_num_rows($sel);
    if($row == 0){
        //Insert ejecucion ot
        $ins = $con->query("insert into ejecucion_ot (ot, dia, hora) values('$ot', '$dia', '$hora')");
    }else{
        header('location:../extend/alerta.php?msj=OT ya Agendada&c=reclamo&p=agendar&t=error');
    }

    if($ins){
        header('location:../extend/alerta.php?msj=Se ingreso con exito&c=reclamo&p=agendar&t=success');
    }else{
        header('location:../extend/alerta.php?msj=No se Pudo ingresar Agendamiento de OT&c=reclamo&p=agendar&t=error');
    }
    $con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=reclamo&p=agendar&t=error');
}   
?>