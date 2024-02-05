<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $comment  = $con->real_escape_string(htmlentities($_POST['comment']));




  $up = $con->query("UPDATE advances SET comment='$comment'  WHERE id='$id' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Avance actualizado&c=cashier&p=cashier&t=success&id='.$id.'');
  }else {
      header('location:../extend/alerta.php?msj=El avance no se pudo actualizar&c=cashier&p=cashier&t=error&id='.$id.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
