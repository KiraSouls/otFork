<?php include'../conn/connn.php';

require '../filtro/vendor/autoload.php';
// contains a variable called: $API_KEY that is the API Key.
// You need this API_KEY created on the Sendgrid website.
include_once('../filtro/credentials.php');

if ($_SERVER['REQUEST_METHOD']== 'POST') {
    $client  = $con->real_escape_string(htmlentities($_POST['client']));
    $branch = $con->real_escape_string(htmlentities($_POST['branch']));
    $contact = $con->real_escape_string(htmlentities($_POST['contact']));    
    $service = $con->real_escape_string(htmlentities($_POST['service']));    
    $ot = $con->real_escape_string(htmlentities($_POST['ot']));    
    $factura = $con->real_escape_string(htmlentities($_POST['factura']));
    $tecnico = $con->real_escape_string(htmlentities($_POST['tecnico']));
    $estado = $con->real_escape_string(htmlentities($_POST['estado']));
    $fecha = $con->real_escape_string(htmlentities($_POST['fecha']));   
    $description = $con->real_escape_string(htmlentities($_POST['description']));
    $causa = $con->real_escape_string(htmlentities($_POST['causa']));
    $solucion = $con->real_escape_string(htmlentities($_POST['solucion']));   
    $number = $_POST['number'];
    $id = $_POST['id'];

    //Obtener id Usuario
    $sel = $con->query("select * from users where id='$number'");
    while ($f = $sel->fetch_assoc()) { 
        $user = $f['id'];
    }
    
    //Update Reclamo
    $update = $con->query("update reclamo set ot='$ot', factura='$factura', id_client='$client', id_branch='$branch', id_contact='$contact', id_users='$user', id_tech='$tecnico', description='$description', solution='$solucion', causa='$causa', status='$estado', fecha_incidente='$fecha' where id='$id'");
    if($update){
        header('location:../extend/alerta.php?msj=Reclamo actualizado&c=reclamo&p=listReclamo&t=success&id='.$id.'');
    }else{
        header('location:../extend/alerta.php?msj=El reclamo no se pudo actualizar&c=reclamo&p=listReclamo&t=error&id='.$id.'');
    }
    $con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=reclamo&p=listReclamo&t=error&id='.$id.'');

}

?>

