<?php include '../extend/header.php';
$number = $con->real_escape_string(htmlentities($_GET['number']));

?>


<div class="row" style="padding-top:10px;">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Agregar Convenio</span>
        <form class="form" action="ins_client.php" method="post">

          <div>
            <label for="client">Cliente</label>
            <select class="browser-default" name="client" id="client" required>
              <option value="0" selected>Selecciona un cliente</option>
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

          <div>
            <label for="estado">Estado</label>
            <select class="browser-default" name="estado" id="estado" required>
              <option value="0" selected>Selecciona un estado</option>
              <option value="Vigente">Vigente</option>
              <option value="Pendiente">Pendiente</option>
              <option value="Cancelada">Cancelada</option>
            </select>
          </div>
          <input id="number" type="text" name="number" value="<?php echo $number ?>" hidden>
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
</body>

</html>