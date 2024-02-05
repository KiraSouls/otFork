<?php
include '../conn/connn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $con->real_escape_string(htmlentities($_POST['id']));
  $email = $con->real_escape_string(htmlentities($_POST['contact_email']));
  $name  = $con->real_escape_string(htmlentities($_POST['contact_name']));
  $department = $con->real_escape_string(htmlentities($_POST['contact_department']));
  $charge = $con->real_escape_string(htmlentities($_POST['contact_charge']));
  $phone = $con->real_escape_string(htmlentities($_POST['contact_phone']));






  if (empty($email) || empty($name)) {
    header('location:../extend/alerta.php?msj=Hay un campo sin especificar&c=us&p=in&t=error');
    exit;
  }



  if (!empty($email)) {
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        header('location:../extend/alerta.php?msj=El correo ingresado no es valido&c=us&p=in&t=error');
        exit;
      }
  }

  //$ins = $con->query("INSERT contacts VALUES('','$name','$phone','$id','$department','$charge','$email')");
  
  $ins = $con->query("INSERT INTO contacts (contact_name, phone, id_branches, department, charge, email) VALUES ('$name','$phone','$id','$department','$charge','$email')");

if ($ins) {
  header('location:../extend/alerta.php?msj=Se ingreso con exito&c=client&p=ins_branch&t=success&id='.$id.'');
}else {
  header('location:../extend/alerta.php?msj=No se pudo ingresar el contacto&c=client&p=ins_branch&t=error&id='.$id.'');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
