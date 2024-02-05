<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $name = $con->real_escape_string(htmlentities($_POST['model_name']));
  $id  = $con->real_escape_string(htmlentities($_POST['id']));
  $id_linea  = $con->real_escape_string(htmlentities($_POST['id_linea']));
  $pal_number  = $con->real_escape_string(htmlentities($_POST['pal_number']));
  $id_sublinea  = $con->real_escape_string(htmlentities($_POST['id_sublinea']));
  $short_desc  = $con->real_escape_string(htmlentities($_POST['short_desc']));
  $long_desc  = $con->real_escape_string(htmlentities($_POST['long_desc']));



  //$ins = $con->query("INSERT model VALUES('','$name','$id','$id_linea','$pal_number','$id_sublinea','$short_desc','$long_desc')");
  $ins = $con->query("INSERT INTO model (name, id_brand, id_linea, pal_number, id_sublinea, short_desc, long_desc) VALUES ('$name','$id','$id_linea','$pal_number','$id_sublinea','$short_desc','$long_desc')");

if ($ins){
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=equipment&p=fuera&t=success&id='.$id.'');
}else{
  header('location:../extend/alerta.php?msj=No se pudo ingresar el modelo&c=equipment&p=fuera&t=error&id='.$id.'');
}
$con->close();
}else{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
