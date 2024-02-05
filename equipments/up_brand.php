<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $name = $con->real_escape_string(htmlentities($_POST['name']));
  $idx = $con->real_escape_string(htmlentities($_POST['id']));




  $up = $con->query("UPDATE brands SET name='$name' WHERE id='$idx' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Marca actualizada&c=equipment&p=update_brand&t=success&id='.$idx.'');
  }else {
      header('location:../extend/alerta.php?msj=No se pudo actualizar la marca&c=equipment&p=update_brand&t=error&id='.$idx.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error');

}
