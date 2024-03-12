<?php include '../extend/header.php';



$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM ots WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $id_client = $f['id_client'];
  $id_branch = $f['id_branch'];
  $id_contact = $f['id_contact'];
  $hours = $f['hours'];
  $created_at = $f['created_at'];
  $type = $f['type'];
  $description = $f['description'];
  $id_service = $f['id_service'];
  $leader = $f['leader'];
  $priority = $f['priority'];
  $status = $f['status'];
  $number_ot = $f['number'];
  $comment = $f['comment'];

  // $valor = strtotime($created_at);
  // $contador = idate('m', $valor) + 1;

  $detalle = $f['detalle'];
  $accesorios = $f['accesorios'];
  $rayones = $f['rayones'];
  $rupturas = $f['rupturas'];
  $tornillos = $f['tornillos'];
  $gomas = $f['gomas'];
  $estado = $f['estado'];
  $observaciones = $f['observaciones'];
  $cargador = $f['cargador'];
  $cable = $f['cable'];
  $adaptador = $f['adaptador'];
  $bateria = $f['bateria'];
  $pantalla = $f['pantalla'];
  $teclado = $f['teclado'];
  $drum = $f['drum'];
  $toner = $f['toner'];
}




$sel_location = $con->query("SELECT location FROM branches WHERE id= '$id_branch' ");
while ($p = $sel_location->fetch_assoc()) {
  $location = $p['location'];
}
?>





<div class="row">
  <div class="col s12">
    <h5>Detalles de orden #<?php echo $number_ot ?></h5>
    <div style='overflow:auto;' class="card horizontal">

      <div class="card-stacked">
        <div class="card-content">
          <form action="up_tech.php" method="post">
            <label for="name_clients"> Nombre del cliente</label>
            <?php
            $sel2 = $con->query("SELECT * FROM clients WHERE id='$id_client'");
            while ($f = $sel2->fetch_assoc()) {
              $client_name = $f['name']  ?>

              <input disabled type="text" name="client_name" value="<?php echo $f['name'] ?>" required>

            <?php  } ?>

            <label for="email">Sucursal</label>
            <?php
            $sel2 = $con->query("SELECT * FROM branches WHERE id='$id_branch'");
            while ($f = $sel2->fetch_assoc()) {
              $name_branch = $f['branch_name'];
              $branch_name = $f['location']    ?>
              <input disabled type="text" name="branch_name" value="<?php echo $f['branch_name'] ?>-<?php echo $f['location'] ?>" required>

            <?php  } ?>
            <label for="rut">Contacto</label>
            <?php
            $sel2 = $con->query("SELECT * FROM contacts WHERE id='$id_contact'");
            while ($f = $sel2->fetch_assoc()) {
              $contact_name = $f['contact_name']  ?>
              <input disabled type="text" name="contact_name" value="<?php echo $f['contact_name'] ?>" required>

            <?php  } ?>

            <label for="phone">Tipo</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
              $type = $f['type']   ?>
              <input disabled type="text" name="type" value="<?php echo $f['type'] ?>" required>

            <?php  } ?>

            <label for="status">Estado</label>


            <input disabled type="text" name="status" value="<?php echo $status ?>" required>


            <label for="hour_price">Encargado</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {  ?>
              <input disabled type="text" name="name_client" value="<?php echo $f['leader'] ?>" required>

            <?php  } ?>

            <label for="hour_price">Técnicos</label>
            <?php
            $sel2 = $con->query("SELECT DISTINCT * FROM participants WHERE ot_number='$number_ot'");
            while ($f = $sel2->fetch_assoc()) {  ?>
              <input disabled type="text" name="name_client" value="<?php echo $f['participant_name'] ?>" required>

            <?php  } ?>

            <label for="hour_price">Servicio</label>
            <?php
            $sel2 = $con->query("SELECT * FROM services WHERE id='$id_service'");
            while ($f = $sel2->fetch_assoc()) {  ?>
              <input disabled type="text" name="name_client" value="<?php echo $f['service_name'] ?>" required>

              <!-- <?php  } ?>

            <label for="hour_price">Fecha:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['created_at'] = date("m");
                                                  ?>" required>
 -->

              <!-- Periodo;

<label for="periodos">Periodo:</label>
<select class="form-control" style="height: 40px;padding-left: 5px;" name="periodo" id="periodo" required>
     <option value="">Seleccione un Periodo</option>
     <option value="1">Enero</option>
     <option value="2">Febrero</option>
     <option value="3">Marzo</option>
     <option value="4">Abril</option>
     <option value="5">Mayo</option>
     <option value="6">Junio</option>
     <option value="7">Julio</option>
     <option value="8">Agosto</option>
     <option value="9">Septiembre</option>
     <option value="10">Octubre</option>
     <option value="11">Noviembre</option>
     <option value="12">Diciembre</option>
</select> -->
              <!-- <label for="hour_price"><?php echo $contador
                                            ?></label> -->


            <?php  } ?>

            <label for="hour_price">¿El Equipo Posee Detalles?</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php
                                                  if ($f['detalle'] == '1') {
                                                    echo 'Si';
                                                  } else {
                                                    echo 'No';
                                                  }
                                                  ?>" required>



            <?php  } ?>

            <label for="hour_price">¿El Equipo Posee Rayones?</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['rayones']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price">¿El Equipo Posee Rupturas?</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['rupturas']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price">¿El Equipo Posee Los Tornillos De Su Carcasa?</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['tornillos']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price">¿El Equipo Posee Las Gomas De La Base En Buen Estado?:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['gomas']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price">Estado del equipo:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['estado']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price">Observaciones Adicionales:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['observaciones']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price">¿El Equipo Posee Accesorios?:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php
                                                  if ($f['accesorios'] == '1') {
                                                    echo 'Si';
                                                  } else {
                                                    echo 'No';
                                                  }
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price">¿El Equipo Posee Cargador?:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['cargador']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price"> ¿El Equipo Posee Cable de Poder?:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['cable']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price"> ¿El Equipo Posee Adaptador de Poder?:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['adaptador']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price"> ¿El Equipo Posee Batería?:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['bateria']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price"> ¿El Equipo Posee Pantalla En Mal Estado?:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['pantalla']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price"> ¿El Equipo Posee Teclado en Mal Estado?:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['teclado']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price"> ¿El Equipo Posee Toner?:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['toner']
                                                  ?>" required>
            <?php  } ?>

            <label for="hour_price"> ¿El Equipo Posee Drum?:</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <input disabled type="text" value="<?php echo $f['drum']
                                                  ?>" required>
            <?php  } ?>


            <label for="hour_price">Tipo</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {  ?>
              <input disabled type="text" name="name_client" value="<?php echo $f['type'] ?>" required>

            <?php  } ?>

            <label for="hour_price">Prioridad</label>
            <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {  ?>
              <input disabled type="text" name="name_client" value="<?php echo $f['priority'] ?>" required>

            <?php  } ?>

            <label for="hour_price">Descripción</label>

            <textarea style="height:150px;" name="" id="" cols="60" rows="90" disabled><?php echo $description ?></textarea>

            <label for="activities">Actividades</label> <br>


            <table class="centered">
              <?php
              $i = 1;
              $sel_ot = $con->query("SELECT a.*, b.name, b.tiempo, c.series_number, c.id_model, d.name AS model_name
                       FROM tasks_equipments AS a
                       JOIN tasks AS b
                       ON a.id_tasks = b.id
                       JOIN equipment AS c
                       ON a.id_equipment=c.id
                       JOIN model as d
                       ON c.id_model=d.id
                       WHERE number_ot = '$number_ot'"); ?>

              <tr>
                <td>Número de serie</td>
                <td>Modelo</td>
                <td>Tarea</td>
                <td>Tiempo (en Minutos)</td>
              </tr>
              <?php

              while ($f = $sel_ot->fetch_assoc()) {
                $id_equipment = $f['id_equipment'];
              ?>

                <tr>
                  <td><?php echo $f['series_number']; ?></td>
                  <td><?php echo $f['model_name']; ?></td>
                  <td>
                    <?php
                    if ($f['status'] == 1) { ?>
                      <input name="activities[]" type="checkbox" id="check<?php echo $i ?>" checked="checked" disabled="disabled">
                    <?php } else { ?>
                      <input name="activities[]" type="checkbox" id="check<?php echo $i ?>" disabled="disabled">
                    <?php } ?>
                    <label for="check<?php echo $i ?>">
                      <?php
                      echo $f['name'];
                      ?>
                    </label>
                  </td>
                  <td><?php echo $f['tiempo']; ?></td>
                </tr>
              <?php $i++;
              } ?>
            </table>



            <label for="hour_price">Comentario del técnico</label>
            <?php
            $sel2 = $con->query("SELECT DISTINCT comment FROM  tasks_equipments WHERE number_ot='$number_ot'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
              <textarea style="height:150px;" name="" id="" cols="60" rows="90" disabled><?php echo $comment ?></textarea>

            <?php  } ?>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php $sel = $con->query("SELECT * FROM advances WHERE ot_number='$number_ot'");
$row = mysqli_num_rows($sel);
?>

<div class="row">
  <div class="col s12">
    <div style="min-height:320px;" class="card">
      <div class="card-content">
        <form action="excel.php" method="post" target="_blank" id="exportar">
          <span class="card-title">Avances(<?php echo $row ?>)</span>
          <button class="btn-floating light-blue darken-2 botonExcel"><i class="material-icons">grid_on</i></button>
          <input type="hidden" name="datos" id="datos">
        </form>
        <table class="excel striped responsive-table" border="1">
          <thead>
            <th>Avance</th>
            <th>Fecha</th>
            <th>Editar</th>
            <th>Eliminar</th>

          </thead>
          <?php while ($f = $sel->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $f['comment'] ?></td>
              <td><?php echo $f['created_at'] ?></td>
              <td><a href="../users/update_advance_admin.php?id=<?php echo $f['id'] ?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
              <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar el avance?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='../users/delete_advance_admin.php?id=<?php echo     $f['id'] ?>'; } else { location.href='detail_ot.php?id=<?php echo $id ?>';} })"><i class="material-icons">clear</i></a></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>



<div class="row">
  <div class=" col s12">
    <p style="color:grey;">Documento de orden</p>

    <div class="card horizontal" style="padding: 10px;">

      <?php
      // Parámetros a pasar al enlace
      $params = array(
        'location' => $location,
        'contact_name' => $contact_name,
        'comment' => $comment,
        'client_name' => $client_name,
        'leader' => $leader,
        'description' => $description,
        'ot_number' => $number_ot,
        'id' => $id,
        'created_at' => $created_at,
        'type' => $type,
        'status' => $status,
        'name_branch' => $name_branch
      );

      // Genera el enlace con los parámetros codificados
      $enlace_generar_pdf = 'orden_de_trabajo.php?' . http_build_query($params);
      ?>

      <a href="<?php echo $enlace_generar_pdf; ?>">
        <button type="submit" class="btn light-blue darken-2" name="button" id="btn-guardar">Generar</button>
      </a>

    </div>
  </div>

</div>




<?php include '../extend/scripts.php'; ?>


</body>

</html>