<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id_servicio =  $con->real_escape_string(htmlentities($_POST['service']));
  $id_tarea = $_POST['task'];
  $num_convenio =  $con->real_escape_string(htmlentities($_POST['id']));



  //Consulta

  foreach ($id_tarea as $val) {
    $ins = $con->query("INSERT INTO detalle_convenio (id_servicio, id_tarea, num_convenio) VALUES ('$id_servicio',$val,'$num_convenio')");
  }


  if ($ins) {
    header('location:../extend/alerta.php?msj=Se ingreso con exito&c=cnv&p=r&t=success');
  } else {
       header('location:../extend/alerta.php?msj=No se pudo ingresar el registro&c=cnv&p=r&t=error');
  }
  $con->close();
} else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cnv&p=r&t=error');
}
