<?php include '../extend/header.php';

?>


<div class="row" style="padding-top:10px;">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Agregar Convenio</span>
        <form class="form" action="ins_conv.php" method="post">

          <div>
            <label for="client">Cliente</label>
            <select class="browser-default" name="id" id="id" required>
              <option value="" selected>Selecciona un cliente</option>
              <?php

              $sel2 = $con->query("SELECT * FROM clients");
              while ($f = $sel2->fetch_assoc()) {  ?>
                <option value='<?php echo $f['id'] ?>'> <?php echo $f['name'] ?></option>
              <?php  } ?>
            </select>
          </div>
          <br>

          <div class="input-field">
            <input type="number" name="v_p" required id="v_p" title="v_p" required>
            <label for="v_p">Visitas Presenciales:</label>
          </div>

          <br>
          <div class="input-field">
            <input type="number" name="v_e" required id="v_e" title="v_e" required>
            <label for="v_e">Visitas de Emergencia:</label>
          </div>

          <div class="input-field">
            <input type="number" name="s_r" required id="s_r" title="s_r" required>
            <label for="s_r">Soporte Remoto:</label>
          </div>
          <br>

          <div class="input-field">
            <input type="number" name="h_t" required id="h_t" title="h_t" required>
            <label for="h_t">Horas Técnicas:</label>
          </div>
          <br>
          <div>
            <label for="estado">Estado</label>
            <select class="browser-default" name="estado" id="estado" required>
              <option value="" selected>Selecciona un estado</option>
              <option value="Vigente">Vigente</option>
              <option value="Pendiente">Pendiente</option>
              <option value="Cancelada">Cancelado</option>
            </select>
          </div>
          <br>
          <br>
          <button type="=submit" class="btn light-blue darken-2" name="button" id="btn-guardar">Guardar</button>

        </form>
      </div>
    </div>
  </div>
</div>


<?php include '../extend/scripts.php'; ?>
<script>

</script>
</body>

</html>