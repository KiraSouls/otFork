<?php
include '../conn/connn.php';
require '../filtro/vendor/autoload.php';
// contains a variable called: $API_KEY that is the API Key.
// You need this API_KEY created on the Sendgrid website.
include_once('../filtro/credentials.php');

date_default_timezone_set("America/Santiago");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    
    //Obtener id Usuario
    $sel = $con->query("select * from users where name='$number'");
    while ($f = $sel->fetch_assoc()) { 
        $user = $f['id'];
    }
    
    //Insert reclamo
    $ins = $con->query("insert into reclamo (ot, factura, id_client, id_branch, id_contact, id_users, id_tech, description, solution, causa, status, fecha_incidente) values('$ot', '$factura', '$client', '$branch', '$contact', '$user', '$tecnico', '$description', '$solucion', '$causa', '$estado', '$fecha')");
    if($ins){
        header('location:../extend/alerta.php?msj=Se ingreso con exito&c=reclamo&p=listReclamo&t=success');
    }else{
        header('location:../extend/alerta.php?msj=No se Pudo ingresar Reclamo&c=reclamo&p=listReclamo&t=error');
    }
    $con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=reclamo&p=listReclamo&t=error');
}   
?>