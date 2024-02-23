<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id_cliente = $con->real_escape_string(htmlentities($_POST['id']));

  $sel2 = $con->query("SELECT number FROM convenios ORDER BY id DESC LIMIT 1");
  while ($f = $sel2->fetch_assoc()) {
    $number = $f['number'] + 1;
  }
  $visitas_presenciales = $con->real_escape_string(htmlentities($_POST['v_p']));
  $visitas_emergencia =  $con->real_escape_string(htmlentities($_POST['v_e']));
  $soporte_remoto = $con->real_escape_string(htmlentities($_POST['s_r']));
  $estado =  $con->real_escape_string(htmlentities($_POST['estado']));



  //Consulta
  $ins = $con->query("INSERT INTO convenios (id_cliente, number, visitas_presenciales, visitas_emergencia, soporte_remoto, estado)
   VALUES ('$id_cliente','$number','$visitas_presenciales','$visitas_emergencia','$soporte_remoto','$estado')");

  if ($ins) {
    header('location:../extend/alerta.php?msj=Se ingreso con exito&c=cnv&p=r&t=success');
  } else {
    header('location:../extend/alerta.php?msj=No se pudo ingresar el registro&c=cnv&p=r&t=error');
  }
  $con->close();
} else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cnv&p=r&t=error');
}
