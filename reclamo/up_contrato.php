<?php
include '../conn/connn.php';
require '../filtro/vendor/autoload.php';
// contains a variable called: $API_KEY that is the API Key.
// You need this API_KEY created on the Sendgrid website.
include_once('../filtro/credentials.php');

date_default_timezone_set("America/Santiago");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $directorio = "../Contratos/";
    $id = $con->real_escape_string(htmlentities($_POST['id']));
    $client = $con->real_escape_string(htmlentities($_POST['client']));
    $branch = $con->real_escape_string(htmlentities($_POST['branch']));
    //$contact = $con->real_escape_string(htmlentities($_POST['contact'])); 
    $tipo = $con->real_escape_string(htmlentities($_POST['tipo']));
    $name = $con->real_escape_string(htmlentities($_POST['name']));
    $nomArchivo = $_FILES['archivo']['name'];
    $guardado = $_FILES['archivo']['tmp_name'];
    $validar = 0;
    
    //Validar tipo de archivo
    $tipoArchivo = strtolower(pathinfo($nomArchivo, PATHINFO_EXTENSION));
    
    if($tipoArchivo == "pdf"){
        //Cambiar nombre al archivo
        $nomArchivo = $name.".".$tipoArchivo;
        $location = $directorio.$nomArchivo;
        
        $sel = $con->query("select * from contrato where id='$id'");
        while ($f = $sel->fetch_assoc()) {
            $locationDelete = $f['location'];
            $nameVal = $f['filename'];
        }
        
        $files = array_diff(scandir($directorio), array('.', '..')); 
        foreach($files as $file){
            // Divides en dos el nombre de tu archivo utilizando el . 
            $data = explode(".", $file);
            // Nombre del archivo
            $fileName = $data[0];
            // Extensión del archivo 
            $fileExtension = $data[1];
            if($nameVal == $fileName){
                $validar = 1;
            }
        }

        if($validar == 1){
            unlink($locationDelete);
        }
        
        $location = $directorio.$nomArchivo;        
        $upt = $con->query("update contrato set type='$tipo', filename='$name', location='$location', client='$client', branche='$branch' where id='$id'");           
        if($upt){
            //Guardar Archivo
            if(move_uploaded_file($_FILES['archivo']['tmp_name'], $location)){
                header('location:../extend/alerta.php?msj=Se ingreso con exito&c=reclamo&p=agendar&t=success');
            }else{
                header('location:../extend/alerta.php?msj=No se Pudo ingresar Contrato&c=reclamo&p=agendar&t=error');
            }
        }else{
            header('location:../extend/alerta.php?msj=No se Pudo ingresar Agendamiento de OT&c=reclamo&p=agendar&t=error');
        }
    }else{
        header('location:../extend/alerta.php?msj=Formato de archivo incorrecto subir archivo en formato PDF&c=reclamo&p=contrato&t=error');
    }     
    $con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=reclamo&p=agendar&t=error');
}   
?>