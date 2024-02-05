<?php include '../extend/header.php';



$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM providers WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $name = $f['name'];
  $email = $f['email'];
  $location = $f['location'];
  $phone = $f['phone'];
  $rut = $f['rut'];
  $id = $f['id'];
}
?>

   <div class="row">
      <div class="col s12">
      <p style="color:grey;">Detalles de proveedor</p>
      <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_provider.php" method="post">
             <label for="name">Nombre</label>
             <input type="text" name="name" value="<?php echo $name ?>" required>
             <label for="rut">Rut</label>
             <input type="text" name="rut" value="<?php echo $rut ?>" required>
             <label for="location">Dirección</label>
             <input type="text" name="location" value="<?php echo $location ?>" required>
             <label for="phone">Teléfono</label>
             <input type="text" name="phone" value="<?php echo $phone ?>" required>
             <input type="text" name="id" value="<?php echo $id ?>" hidden>
             <label for="email">Correo</label>
             <input type="text" name="email" value="<?php echo $email ?>" required>

               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>
     </div>


     <div class="row">
<div class=" col s12">
<p style="color:grey;"> Ejecutivo(a)</p>
       <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_client.php" method="post">
             <table class="excel striped responsive-table" border="1">
                    <thead>
                      <th>Nombre</th>
                      <th>Correo</th>
                      <th>Teléfono</th>
                      <th>Editar</th>
                      <th class="borrar">Eliminar</th>
                    </thead>
                   <?php
                     $sel2 = $con->query("SELECT * FROM executives WHERE id_providers = '$id' ");


                     while ($f = $sel2->fetch_assoc()) {  ?>
                        <tr>
                        <td><?php echo $f['name'] ?></td>
                        <td><?php echo $f['email'] ?></td>
                        <td><?php echo $f['phone'] ?></td>
                        <td><a href="update_executive.php?id=<?php echo $f['id']?>&id_provider=<?php echo $id?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar el ejecutivo?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_executive.php?id=<?php echo $f['id'] ?>&id_provider=<?php echo $id?>'; } else { location.href='update_provider.php?id=<?php echo $id ?>';} })"><i class="material-icons">clear</i></a></td>
                      </tr>

                    <?php  } ?>

             <a href="add_executive.php?id=<?php echo $id?>"> + Agregar</a>
             </form>
           </div>
         </div>
      </div>
     </div>

</div>



<script>
function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');

    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();

    // Formatear RUN
    rut.value = cuerpo + '-'+ dv

    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}

    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;

    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {

        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);

        // Sumar al Contador General
        suma = suma + index;

        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }

    }

    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);

    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;

    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }

    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
}




</script>

   <?php include '../extend/scripts.php'; ?>


   </body>
   </html>
