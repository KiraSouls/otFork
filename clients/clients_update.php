<?php include '../extend/header.php';



$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM clients WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $name = $f['name'];
  $email = $f['email'];
  $rut = $f['rut'];
  $phone = $f['phone'];
  $web = $f['web'];
  $idx = $f['id'];
}
?>

<div class="row">
  <div class="col s12">
    <p style="color:grey;">Detalles de cliente</p>
    <div class="card horizontal">

      <div class="card-stacked">
        <div class="card-content">
          <form action="up_client.php" method="post">
            <label for="name">Nombre</label>
            <input type="text" name="name" value="<?php echo $name ?>" required>
            <label for="email">Correo</label>
            <input type="text" name="email" value="<?php echo $email ?>" required>
            <label for="rut">Rut</label>
            <input type="text" name="rut" value="<?php echo $rut ?>" id="rut" oninput="checkRut(this)" required>
            <input type="text" name="id" value="<?php echo $idx ?>" hidden>
            <label for="web">web</label>
            <input type="text" name="web" value="<?php echo $web ?>" required>
            <label for="phone">Teléfono</label>
            <input type="text" name="phone" value="<?php echo $phone ?>" required>



            <button type="submit" class="btn light-blue darken-2">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$sel2 = $con->query("SELECT * FROM branches WHERE id = '$id' ");

while ($f = $sel2->fetch_assoc()) {
  $location = $f['location'];
  $phone = $f['phone'];
}
?>


<div class="row">
  <div class=" col s12">
    <p style="color:grey;">Sucursales</p>
    <div class="card horizontal" style="overflow:auto;">

      <div class="card-stacked">
        <div class="card-content">
          <form action="up_client.php" method="post">
            <table class="excel responsive-table" border="1">
              <thead>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Teléfono</th>
                <th>Editar</th>
                <th class="borrar">Eliminar</th>
              </thead>
              <?php
              $sel2 = $con->query("SELECT * FROM branches WHERE id_clients = '$id' ");


              while ($f = $sel2->fetch_assoc()) {  ?>
                <tr>
                  <td><?php echo $f['branch_name'] ?></td>
                  <td><?php echo $f['location'] ?></td>
                  <td><?php echo $f['phone'] ?></td>
                  <td><a href="ins_branch.php?id=<?php echo $f['id'] ?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                  <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar la sucursal?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_branch.php?id=<?php echo $f['id'] ?>&idx=<?php echo $id ?>'; } else { location.href='clients_update.php?id=<?php echo $idx ?>';} })"><i class="material-icons">clear</i></a></td>
                </tr>

              <?php  } ?>

              <a href="add_branch.php?id=<?php echo $idx ?>"> + Agregar</a>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
<script>
  function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.', '');
    // Despejar Guión
    valor = valor.replace('-', '');

    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0, -1);
    dv = valor.slice(-1).toUpperCase();

    // Formatear RUN
    rut.value = cuerpo + '-' + dv

    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if (cuerpo.length < 7) {
      rut.setCustomValidity("RUT Incompleto");
      return false;
    }

    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;

    // Para cada dígito del Cuerpo
    for (i = 1; i <= cuerpo.length; i++) {

      // Obtener su Producto con el Múltiplo Correspondiente
      index = multiplo * valor.charAt(cuerpo.length - i);

      // Sumar al Contador General
      suma = suma + index;

      // Consolidar Múltiplo dentro del rango [2,7]
      if (multiplo < 7) {
        multiplo = multiplo + 1;
      } else {
        multiplo = 2;
      }

    }

    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);

    // Casos Especiales (0 y K)
    dv = (dv == 'K') ? 10 : dv;
    dv = (dv == 0) ? 11 : dv;

    // Validar que el Cuerpo coincide con su Dígito Verificador
    if (dvEsperado != dv) {
      rut.setCustomValidity("RUT Inválido");
      return false;
    }

    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
  }
</script>

<?php include '../extend/scripts.php'; ?>
</body>

</html>