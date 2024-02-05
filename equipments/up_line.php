<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $name = $con->real_escape_string(htmlentities($_POST['line_name']));
  $idx = $con->real_escape_string(htmlentities($_POST['id']));




  $up = $con->query("UPDATE linea SET name='$name' WHERE id='$idx' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Linea actualizada&c=equipment&p=fuera&t=success');
  }else {
      header('location:../extend/alerta.php?msj=No se pudo actualizar la linea&c=equipment&p=fuera&t=error');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error');

}
