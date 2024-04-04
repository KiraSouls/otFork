<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.css">
  <title>Document</title>
</head>

<body>
  <?php
  $mensaje = ($_GET['msj']);
  $c = htmlentities($_GET['c']);
  $p = htmlentities($_GET['p']);
  $t = htmlentities($_GET['t']);

  switch ($c) {
    case 'cnv':
      $carpeta = "../convenios/";
      break;
    case 'us':
      $carpeta = "../users/";
      break;
    case 'u':
      $carpeta = "../home/";
      break;
    case 'equipment':
      $carpeta = "../equipments/";
      break;
    case 'config':
      $carpeta = "../config/";
      break;
    case 'service':
      $carpeta = "../services/";
      break;
    case 'ots':
      $carpeta = "../ots/";
      break;
    case 'client':
      $carpeta = "../clients/";
      break;
    case 'replacement':
      $carpeta = "../replacements/";
      break;
    case 'tech':
      $carpeta = "../techs/";
      break;
    case 'provider':
      $carpeta = "../providers/";
      break;
    case 'home':
      $carpeta = "../ots/";
      break;
    case 'clubempresa':
      $carpeta = "../";
      break;
    case 'club':
      $carpeta = "../";
      break;
    case 'salir':
      $carpeta = "../";
      break;
    case 'perfil':
      $carpeta = "../perfil/";
      break;
    case 'ofer':
      $carpeta = "../ofertas/";
      break;
    case 'normal':
      $carpeta = "../";
      break;
    case 'reg':
      $carpeta = "../";
      break;
    case 'fuera':
      $carpeta = "../";
      break;
    case 'donde':
      $carpeta = "../";
      break;
    case 'mail':
      $carpeta = "../login/";
      break;
    case 'ereserva':
      $carpeta = "../reservas/";
      break;
    case 'coment':
      $carpeta = "../comentarios/";
      break;
    case 'soli':
      $carpeta = "../solicitudes/";
      break;
    case 'cashier':
      $carpeta = "../users/";
      break;
      //Nuevo
    case 'reclamo':
      $carpeta = "../reclamo/";
      break;
  }
  switch ($p) {
    case 'r':
      $pagina = "index-convenios.php";
      break;
    case 'uc':
      $pagina = "update_conv.php";
      break;

    case 'in':
      $pagina = "users.php";
      break;
    case 'techin':
      $pagina = "index-techs.php";
      break;
    case 'tech':
      $pagina = "tech.php";
      break;
    case 'update_model':
      $pagina = "update_model.php";
      break;
    case 'update_line':
      $pagina = "update_subline.php";
      break;
    case 'update_brand':
      $pagina = "update_brand.php";
      break;
    case 'parameter_area':
      $pagina = "add_parameter_area.php";
      break;
    case 'up_provider':
      $pagina = "update_provider.php";
      break;
    case 'up_service':
      $pagina = "update_service.php";
      break;
    case 'up_tech':
      $pagina = "update_tech.php";
      break;
    case 'home':
      $pagina = "index.php";
      break;
    case 'club':
      $pagina = "perfil.php";
      break;
    case 'home':
      $pagina = "clubEmpresa.php";
      break;
    case 'salir':
      $pagina = "gallery.html";
      break;
    case 'perfil':
      $pagina = "perfil.php";
      break;
    case 'img':
      $pagina = "imagenes.php";
      break;
    case 'normal':
      $pagina = "perfil.php";
      break;
    case 'reg':
      $pagina = "comunidad.php";
      break;
    case 'resume':
      $pagina = "resume_ot.php";
      break;
    case 'fuera':
      $pagina = "index.php";
      break;
    case 'donde':
      $pagina = "reserva2.php";
      break;
    case 'mail':
      $pagina = "index.php";
      break;
    case 'reserva':
      $pagina = "comunidad_reservas.php";
      break;
    case 'login':
      $pagina = "inicio";
      break;
    case 'upclub':
      $pagina = "imagenes_club.php";
      break;
    case 'upempresa':
      $pagina = "imagenes_empresa.php";
      break;
    case 'datosclub':
      $pagina = "comunidad_perfil.php";
      break;
    case 'datoscon':
      $pagina = "datosCONVENIO.php";
      break;
    case 'cashier':
      $pagina = "tech.php";
      break;
    case 'clients_update':
      $pagina = "clients_update.php";
      break;
    case 'ins_branch':
      $pagina = "ins_branch.php";
      break;
    case 'update_ot':
      $pagina = "update_ot.php";
      break;
    case 'ot':
      $pagina = "ot.php";
      break;
      //Nuevo
    case 'listReclamo':
      $pagina = "index.php";
      break;
    case 'agendar':
      $pagina = "agendamiento.php";
      break;
  }


  if (isset($_GET['id'])) {
    $id = htmlentities($_GET['id']);
    $dir = $carpeta . $pagina . '?id=' . $id;
  } else {
    $dir = $carpeta . $pagina;
  }


  if ($t == "error") {
    $titulo = "Oppss..";
  } else if ($t == "mail") {
    $titulo = "Se enviará un correo de activación para finalizar el registro de tu cuenta";
  } else {
    $titulo = "Buen trabajo";
  }

  ?>


  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.js"></script>

  <script>
    swal({
      title: '<?php echo $titulo ?>',
      text: "<?php echo $mensaje ?>",
      type: '<?php echo $t ?>',
      confirmButtonColor: 'black',
      confirmButtonText: 'Ok',
    }).then(function() {

      location.href = '<?php echo $dir ?>';
    });

    $(document).click(function() {
      location.href = '<?php echo $dir ?>';
    });


    $(document).keyup(function(e) {
      if (e.wich == 27) {
        location.href = '<?php echo $dir ?>';
      }

    });
  </script>

</body>

</html>
