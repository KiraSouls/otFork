<?php include'../conn/connn.php';

require '../filtro/vendor/autoload.php';
// contains a variable called: $API_KEY that is the API Key.
// You need this API_KEY created on the Sendgrid website.
include_once('../filtro/credentials.php');

if ($_SERVER['REQUEST_METHOD']== 'POST') {
    $ot  = $con->real_escape_string(htmlentities($_POST['ot']));
    $dia = $con->real_escape_string(htmlentities($_POST['dia']));
    $hora = $con->real_escape_string(htmlentities($_POST['hora']));      
    $id = $_POST['id'];
    
    //Update Reclamo
    $update = $con->query("update ejecucion_ot set ot='$ot', dia='$dia', hora='$hora' where ot='$id'");
    if($update){
        header('location:../extend/alerta.php?msj=Agendamiento actualizado&c=reclamo&p=agendar&t=success&id='.$id.'');
    }else{
        header('location:../extend/alerta.php?msj=El Agendamiento no se pudo actualizar&c=reclamo&p=agendar&t=error&id='.$id.'');
    }
    $con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=reclamo&p=agendar&t=error&id='.$id.'');

}

?>

