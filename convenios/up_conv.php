<?php include '../conn/connn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $id_cliente = $con->real_escape_string(htmlentities($_POST['cliente']));
  $id_branch = $con->real_escape_string(htmlentities($_POST['branch']));
  $visitas_presenciales = $con->real_escape_string(htmlentities($_POST['v_p']));
  $visitas_emergencia =  $con->real_escape_string(htmlentities($_POST['v_e']));
  $soporte_remoto = $con->real_escape_string(htmlentities($_POST['s_r']));
  $horas_tecnicas = $con->real_escape_string(htmlentities($_POST['h_t']));
  $estado =  $con->real_escape_string(htmlentities($_POST['estado']));



  $up = $con->query("UPDATE convenios SET id_cliente='$id_cliente', id_branch='$id_branch', visitas_presenciales='$visitas_presenciales', visitas_emergencia='$visitas_emergencia'
  , soporte_remoto='$soporte_remoto', horas_tecnicas='$horas_tecnicas',estado='$estado'  WHERE id='$id' ");


  if ($up) {
    header('location:../extend/alerta.php?msj=Convenio actualizado&c=cnv&p=r&t=success');
  } else {
    header('location:../extend/alerta.php?msj=No se pudo actualizar el convenio&c=cnv&p=r&t=error');
  }

  $con->close();
}
