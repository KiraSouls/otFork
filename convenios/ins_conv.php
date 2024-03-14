<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id_cliente = $con->real_escape_string(htmlentities($_POST['client']));
  $id_branch = $con->real_escape_string(htmlentities($_POST['branch']));


  $visitas_presenciales = $con->real_escape_string(htmlentities($_POST['v_p']));
  $visitas_emergencia =  $con->real_escape_string(htmlentities($_POST['v_e']));
  $soporte_remoto = $con->real_escape_string(htmlentities($_POST['s_r']));
  $horas_tecnicas = $con->real_escape_string(htmlentities($_POST['h_t']));
  $estado =  $con->real_escape_string(htmlentities($_POST['estado']));



  //Consulta
  $ins = $con->query("INSERT INTO convenios (id_cliente, id_branch, visitas_presenciales, visitas_emergencia, soporte_remoto, horas_tecnicas, estado)
   VALUES ('$id_cliente','$id_branch','$visitas_presenciales','$visitas_emergencia','$soporte_remoto', '$horas_tecnicas', '$estado')");

  if ($ins) {
    header('location:../extend/alerta.php?msj=Se ingreso con exito&c=cnv&p=r&t=success');
  } else {
    //  header('location:../extend/alerta.php?msj=No se pudo ingresar el registro&c=cnv&p=r&t=error');
    echo $id_cliente;
    echo $id_branch;
    echo $visitas_emergencia;
    echo $visitas_presenciales;
    echo $soporte_remoto;
    echo $horas_tecnicas;
    echo $estado;
  }
  $con->close();
} else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cnv&p=r&t=error');
}
