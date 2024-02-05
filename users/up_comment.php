<?php include'../conn/connn.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $comment  = $con->real_escape_string(htmlentities($_POST['comment']));




  $up = $con->query("UPDATE ots SET comment='$comment'  WHERE id='$id' ");


  if ($up) {
      header('location:../extend/alerta.php?msj=Comentario actualizado&c=cashier&p=ot&t=success&id='.$id.'');
  }else {
      header('location:../extend/alerta.php?msj=El comentario no se pudo actualizar&c=cashier&p=ot&t=error&id='.$id.'');
  }

$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ofer&p=img&t=error&id='.$id.'');

}
