<?php
include '../conn/connn.php';
require '../filtro/vendor/autoload.php';
// contains a variable called: $API_KEY that is the API Key.
// You need this API_KEY created on the Sendgrid website.
include_once('../filtro/credentials.php');

date_default_timezone_set("America/Santiago");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $directorio = "../Contratos/";
    $client = $con->real_escape_string(htmlentities($_POST['client']));
    $branch = $con->real_escape_string(htmlentities($_POST['branch']));
    //$contact = $con->real_escape_string(htmlentities($_POST['contact'])); 
    $tipo = $con->real_escape_string(htmlentities($_POST['tipo']));
    $name = $con->real_escape_string(htmlentities($_POST['name']));
    $nomArchivo = $_FILES['archivo']['name'];
    $guardado = $_FILES['archivo']['tmp_name'];
    $validar = 1;
    //Validar tipo de archivo
    $tipoArchivo = strtolower(pathinfo($nomArchivo, PATHINFO_EXTENSION));
    
    if($tipoArchivo == "pdf"){
        //Cambiar nombre al archivo
        $nomArchivo = $name.".".$tipoArchivo;
        $location = $directorio.$nomArchivo;
        //Validar que archivo no exista
        $files = array_diff(scandir($directorio), array('.', '..')); 
        foreach($files as $file){
            // Divides en dos el nombre de tu archivo utilizando el . 
            $data = explode(".", $file);
            // Nombre del archivo
            $fileName = $data[0];
            // Extensión del archivo 
            $fileExtension = $data[1];
            if($name == $fileName){
                $validar = 0;
            }
        }
        
        if($validar == 1){
            $ins = $con->query("insert into contrato (type, filename, location, client, branche) values ('$tipo', '$name', '$location', '$client', '$branch')");   
            if($ins){                
                //Guardar Archivo
                if(move_uploaded_file($_FILES['archivo']['tmp_name'], $location)){
                    //echo "subido";
                    header('location:../extend/alerta.php?msj=Se ingreso con exito&c=reclamo&p=agendar&t=success');
                }else{
                    //echo "error subir";
                    header('location:../extend/alerta.php?msj=No se Pudo ingresar Contrato&c=reclamo&p=agendar&t=error');
                }
        }else{
            //echo "error crear";
            header('location:../extend/alerta.php?msj=Archivo ya Ingresado&c=reclamo&p=agendar&t=error');
        }
        
    }else{
        //header('location:../extend/alerta.php?msj=No se Pudo ingresar Agendamiento de OT&c=reclamo&p=agendar&t=error');
    }
    }else{
        //header('location:../extend/alerta.php?msj=Formato de archivo incorrecto subir archivo en formato PDF&c=reclamo&p=contrato&t=error');
    }     
    $con->close();
}else {
  //header('location:../extend/alerta.php?msj=Utiliza el formulario&c=reclamo&p=agendar&t=error');
}   
?>
