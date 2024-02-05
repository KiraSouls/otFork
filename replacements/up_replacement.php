<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $name  = $con->real_escape_string(htmlentities($_POST['name']));
  $description = $con->real_escape_string(htmlentities($_POST['description']));
  $brand = $con->real_escape_string(htmlentities($_POST['brand']));
  $price = $con->real_escape_string(htmlentities($_POST['price']));


  $up = $con->query("UPDATE replacements SET  name='$name', price='$price', description='$description', brand='$brand' WHERE id='$id' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Repuesto actualizado&c=replacement&p=fuera&t=success&id='.$id.'');
  }else {
      header('location:../extend/alerta.php?msj=El repuesto no se pudo actualizar&c=replacement&p=fuera&t=error&id='.$id.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
