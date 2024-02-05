<?php

include '../conn/connn.php';
?>

<?php include '../extend/header.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="ckfinder/ckfinder.js"></script>
  </head>
  <body>
  <h1> Listado de correos</h1>
  <div class="row">
     <div class="col s12">
      <div class="card">
        <div class="card-content">
    <?php

      $opcion = $_POST['filtro'];
      $i=0;


      if ($opcion=="todos") {
        //vaciar arreglo
        unset($strCorreos);

        //Consulta
        $sel = $con->query("SELECT correo FROM usuarios");

        //Resultados
        while ($f = $sel->fetch_assoc()) {

        //Capturar correos
        $strCorreos [$i]= $f['correo'];
        $i++;

        echo  $f['correo'];?><br><?php
        }
      }
      
      if ($opcion=="estudiante") {
        //vaciar arreglo
        unset($strCorreos);

        //Consulta
        $sel = $con->query("SELECT correo FROM usuarios
        where ocupacion= 'Estudiante'");

        //Resultados
        while ($f = $sel->fetch_assoc()) {

        //Capturar correos
        $strCorreos [$i]= $f['correo'];
        $i++;

        echo  $f['correo'];?><br><?php
        }
      }
      if ($opcion=="club") {

        //vaciar arreglo
        unset($strCorreos);
        unset($_SESSION['correos']);
        //Consulta
        $sel = $con->query("SELECT correo FROM usuarios
        where nivel= 'CLUBFIKA'");

        //Resultados
        while ($f = $sel->fetch_assoc()) {

        //Capturar correos
        $strCorreos [$i]= $f['correo'];
        $_SESSION['correos'][$i]=$strCorreos[$i];
        $i++;

        echo  $f['correo'];?><br><?php

        }
      }if ($opcion=="convenio") {
        //vaciar arreglo
        unset($strCorreos);

        //Consulta
        $sel = $con->query("SELECT correo FROM usuarios
        where nivel= 'CONVENIO' ");

        //Resultados
        while ($f = $sel->fetch_assoc()) {

        //Capturar correos
        $strCorreos [$i]= $f['correo'];
        $i++;

        echo  $f['correo'];?><br><?php
        }
      }


    ?>
  </div>
</div>
</div>
</div>

<div class="row">
   <div class="col s12 m6 l6">
     <div class="card">
       <div class="card-content">
         <a><img src="../img/captura.png" width="500" height="500"></a>
       </div>
     </div>
    </div>
    <div class="col s12 m6 l6">
     <div class="card">
       <div class="card-content">
         <h4>Edita el correo</h4>
         <form class="" action="sendmail.php" method="post">
           <div class="input-field">
             <input type="text" name="asunto" title="asunto" id="asunto">
             <label for="nombre">Asunto:</label>
           </div>
           <div class="input-field col s12">
             <textarea id="comentario" name="comentario" class="materialize-textarea"></textarea>
             <label for="comentario">Texto superiror</label>
           </div>
           <h3>Imagen</h3>
         </div>
         <div class="input-field col s12">
           <textarea id="comentario" name="comentario" class="materialize-textarea"></textarea>
           <label for="comentario">Texto inferior</label>
         </div>
           <button type="=submit"  class="btn black" name="button" id="btn-guardar">Enviar<i class="material-icons">send</i></button>
         </form>


       </div>
    </div>
    </div>
  </div>

  </body>

</html>
<script type="text/javascript" src="../ofertas/ckfinder/ckfinder.js"></script>

<?php include '../extend/scripts.php'; ?>
