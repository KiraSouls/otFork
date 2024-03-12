<?php include '../extend/header.php';



$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM convenios WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $id = $f['id'];
  $id_cliente = $f['id_cliente'];
  $id_branch = $f['id_branch'];
  $visitas_presenciales = $f['visitas_presenciales'];
  $visitas_emergencia = $f['visitas_emergencia'];
  $soporte_remoto = $f['soporte_remoto'];
  $horas_tecnicas = $f['horas_tecnicas'];
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
              <select class="browser-default" name="cliente" id="cliente" required>
                <option value="" selected>Selecciona un cliente</option>
                <?php
                $sel2 = $con->query("SELECT * FROM clients");
                while ($f = $sel2->fetch_assoc()) {  ?>
                  <!-- si quieres guardar otro cliente -> usa el echo $f['id'] en vez del echo $id_cliente -->
                  <option value='<?php echo $id_cliente ?>' <?php if ($f['id'] == $id_cliente) {
                                                              echo 'selected';
                                                            } ?>> <?php echo $f['name'] ?></option>
                <?php  } ?>
              </select>
            </div>
            <br>

            <div>
              <label for="client">Sucursal</label>
              <select class="browser-default" name="branch" id="branch" required>
                <option value="" selected>Selecciona una sucursal</option>
                <?php
                $sel2 = $con->query("SELECT * FROM branches");
                while ($f = $sel2->fetch_assoc()) {  ?>
                  <option value='<?php echo $f['id']; ?>' <?php if ($f['id'] == $id_branch) {
                                                            echo 'selected';
                                                          } ?>> <?php echo $f['location'] ?></option>
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
            <div class="input-field">
              <input type="number" name="h_t" required id="h_t" title="Horas Tecnicas" value="<?php echo $horas_tecnicas; ?>">
              <label for="h_t">Horas Técnicas:</label>
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
                <option value="Cancelado" <?php if ($estado == 'Cancelado') {
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
// $sel2 = $con->query("SELECT * FROM detalle_convenio WHERE num_convenio = '$number' ");

// while ($f = $sel2->fetch_assoc()) {
//   $servicio = $f['service_name'];
//   $tarea = $f['name'];
// }
?>


<div class="row">
  <div class=" col s12">
    <p style="color:grey;">Detalle del Convenio</p>
    <div class="card horizontal" style="overflow:auto;">

      <div class="card-stacked">
        <div class="card-content">
          <form action="" method="post">

            <table class="excel responsive-table" border="1">
              <thead>
                <th>Servicio</th>
                <th>Tarea</th>

                <th class="borrar">Eliminar</th>
              </thead>
              <?php

              $i = 1;
              $seld = $con->query("SELECT a.id as id_detalle, b.service_name, c.name, d.id 
              -- , d.id
                        FROM detalle_convenio AS a
                        JOIN services AS b
                        ON a.id_servicio = b.id
                        JOIN tasks AS c
                        ON a.id_tarea=c.id
                        JOIN convenios AS d
                        ON a.num_convenio=d.id
                        WHERE num_convenio = '$id'");

              while ($f = $seld->fetch_assoc()) {
                $servicio = $f['service_name'];
                $tarea = $f['name'];
                $id_detalle = $f['id_detalle'];

              ?>
                <tr>
                  <td><?php echo $servicio ?></td>
                  <td><?php echo $tarea ?></td>
                  <td class="borrar">
                    <a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar este registro?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_detalle.php?id=<?php echo $id_detalle ?>&idx=<?php echo $id_detalle ?>'; } else { location.href='#';} })"><i class="material-icons">clear</i></a>
                  </td>
                </tr>

              <?php
              }
              ?>
              <!-- 
SELECT * FROM `ots` WHERE MONTH(created_at) = "10" and year(created_at) = "2019"; -->

              <a href="add_detalle.php?id=<?php echo $id ?>"> + Agregar</a>
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