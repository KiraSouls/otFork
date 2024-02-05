<?php
include '../conn/connn.php';
require '../filtro/vendor/autoload.php';
// contains a variable called: $API_KEY that is the API Key.
// You need this API_KEY created on the Sendgrid website.
include_once('../filtro/credentials.php');

$id = htmlentities($_GET['id']);
$sel = $con->query("SELECT * FROM contrato WHERE id = '$id' ");
while ($f = $sel->fetch_assoc()) {
    $location = $f['location'];    
}
echo $location;
$mi_pdf = fopen ($location, "r");
if (!$mi_pdf) {
    echo "<p>No puedo abrir el archivo para lectura</p>";
    exit;
}

header('Content-type: application/pdf');

fpassthru($mi_pdf);  
//fclose ($archivo);
?>