<?php
include '../conn/connn.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $activity_name = $con->real_escape_string(htmlentities($_POST['name']));
  $hours  = $con->real_escape_string(htmlentities($_POST['hours']));
  $created_at = date("Y-m-d H:i:s");



  $ins = $con->query("INSERT INTO activities (name, created_at, hours, id_ot) VALUES ('$activity_name','$created_at','$hours','$id')");

  if ($ins) {
    $up = $con->query("UPDATE ots SET status='pendiente'  WHERE id = '$id' ");
    header('location:../extend/alerta.php?msj=La actividad se ingreso con exito, la orden se encuentra en estado PENDIENTE&c=home&p=cashier&t=success');
  } else {
    header('location:../extend/alerta.php?msj=No se pudo ingresar la actividad&c=home&p=cashier&t=error');
  }
  $con->close();
} else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
