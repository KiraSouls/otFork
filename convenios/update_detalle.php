<?php include '../extend/header.php';



$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM convenios WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $id = $f['id'];
  $id_cliente = $f['id_cliente'];
  $visitas_presenciales = $f['visitas_presenciales'];
  $visitas_emergencia = $f['visitas_emergencia'];
  $soporte_remoto = $f['soporte_remoto'];
  $estado = $f['estado'];
}
?>

<div class="row">
  <div class="col s12">
    <p style="color:grey;">Convenio</p>
    <div class="card horizontal">
      <div class="card-stacked">
        <div class="card-content">
          <form action="up_conv.php" method="post">

            <div>
              <label for="client">Cliente</label>
              <select class="browser-default" name="cli" id="cli" required>
                <option disabled value="" selected>Selecciona un cliente</option>
                <?php
                $sel2 = $con->query("SELECT * FROM clients");
                while ($f = $sel2->fetch_assoc()) {  ?>
                  <option disabled value='<?php echo $id_cliente ?>' <?php if ($f['id'] == $id_cliente) {
                                                                        echo 'selected';
                                                                      } ?>> <?php echo $f['name'] ?></option>
                <?php  } ?>
              </select>
            </div>
            <br>

            <div class="input-field">
              <input type="number" name="v_p" required id="v_p" title="Visitas Presenciales" value="<?php echo $visitas_presenciales; ?>">
              <label for="v_p">Visitas Presenciales:</label>
            </div>

            <br>
            <div class="input-field">
              <input type="number" name="v_e" required id="v_e" title="Visitas de Emergencia" value="<?php echo $visitas_emergencia; ?>">
              <label for="v_e">Visitas de Emergencia:</label>
            </div>
            <div class="input-field">
              <input type="number" name="s_r" required id="s_r" title="Soporte Remoto" value="<?php echo $soporte_remoto; ?>">
              <label for="s_r">Soporte Remoto:</label>
            </div>
            <br>
            <div>
              <label for="estado">Estado</label>
              <select class="browser-default" name="estado" id="estado" required>
                <option value="">Selecciona un estado</option>
                <option value="Vigente" <?php if ($estado == 'Vigente') {
                                          echo 'selected';
                                        } ?>>Vigente</option>
                <option value="Pendiente" <?php if ($estado == 'Pendiente') {
                                            echo 'selected';
                                          } ?>>Pendiente</option>
                <option value="Cancelada" <?php if ($estado == 'Cancelado') {
                                            echo 'selected';
                                          } ?>>Cancelado</option>
              </select>
            </div>
            <input id="id" type="text" name="id" value="<?php echo $id ?>" hidden>
            <br>
            <br>
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
    <p style="color:grey;">Detalle del Convenio</p>
    <div class="card horizontal" style="overflow:auto;">

      <div class="card-stacked">
        <div class="card-content">
          <form action="up_client.php" method="post">
            <table class="excel responsive-table" border="1">
              <thead>
                <th>Servicio</th>
                <th>Tarea</th>
                <th>Editar</th>
                <th class="borrar">Eliminar</th>
              </thead>
              <?php
              $sel2 = $con->query("SELECT * FROM branches WHERE id_clients = '$id' ");


              while ($f = $sel2->fetch_assoc()) {  ?>
                <tr>
                  <td><?php echo $f['branch_name'] ?></td>
                  <td><?php echo $f['location'] ?></td>
                  <td><a href="ins_detalle.php?id=<?php echo $f['id'] ?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                  <td class="borrar"><a href="#" class="" onclick="swal({ title:'Esta seguro que desea eliminar la sucursal?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_detalle.php?id=<?php echo $f['id'] ?>&idx=<?php echo $id ?>'; } else { location.href='clients_update.php?id=<?php echo $idx ?>';} })"><i class="material-icons">clear</i></a></td>
                </tr>

              <?php  } ?>

              <a href="add_detalle.php?id=<?php echo $idx ?>"> + Agregar</a>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
<script>

</script>

<?php include '../extend/scripts.php'; ?>
</body>

</html>