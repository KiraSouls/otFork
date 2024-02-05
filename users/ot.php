<?php include '../extend/header_tech.php';





$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM ots WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $id_client = $f['id_client'];
  $id_branch = $f['id_branch'];
  $id_contact = $f['id_contact'];
  $type = $f['type'];
  $hours = $f['hours'];
  $id_service = $f['id_service'];
  $leader = $f['leader'];
  $description = $f['description'];
  $id_task = $f['id_task'];
  $number_ot = $f['number'];
  $comment = $f['comment'];
  $created_at = $f['created_at'];
  $status = $f['status'];
}

$sel_location = $con->query("SELECT location FROM branches WHERE id= '$id_branch' ");
while ($p = $sel_location->fetch_assoc()) {
  $location = $p['location'];
}
?>

<div class="row">
    <div class="col s12">
        <p style="color:grey;">Detalles de orden</p>
        <div class="card horizontal">

            <div class="card-stacked">
                <div class="card-content">
                    <form action="up_tech.php" method="post">


                        <h5>Orden #<?php echo $number_ot ?></h5>


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
                        <input disabled type="text" name="branch_name"
                            value="<?php echo $f['branch_name'] ?>-<?php echo $f['location'] ?>" required>

                        <input type="text" value="Fono: <?php echo $f['phone'] ?>" disabled>

                        <?php  } ?>
                        <label for="rut">Contacto</label>
                        <?php
            $sel2 = $con->query("SELECT * FROM contacts WHERE id='$id_contact'");
            while ($f = $sel2->fetch_assoc()) {
              $contact_name = $f['contact_name']  ?>
                        <input disabled type="text" name="contact_name"
                            value="<?php echo $f['contact_name'] ?> / Fono: <?php echo $f['phone'] ?>" required>

                        <?php  } ?>

                        <label for="phone">Tipo</label>
                        <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {
              $type = $f['type']   ?>
                        <input disabled type="text" name="type" value="<?php echo $f['type'] ?>" required>

                        <?php  } ?>
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
                        <input disabled type="text" name="name_client" value="<?php echo $f['participant_name'] ?>"
                            required>

                        <?php  } ?>

                        <label for="hour_price">Servicio</label>
                        <?php
            $sel2 = $con->query("SELECT * FROM services WHERE id='$id_service'");
            while ($f = $sel2->fetch_assoc()) {  ?>
                        <input disabled type="text" name="name_client" value="<?php echo $f['service_name'] ?>"
                            required>

                        <?php  } ?>

                        <label for="hour_price">Tarea</label>
                        <?php
            $sel2 = $con->query("SELECT * FROM tasks WHERE id='$id_task'");
            while ($f = $sel2->fetch_assoc()) {  ?>
                        <input disabled type="text" name="name_client" value="<?php echo $f['name'] ?>" required>

                        <?php  } ?>

                        <label for="hour_price">Prioridad</label>
                        <?php
            $sel2 = $con->query("SELECT * FROM ots WHERE id='$id'");
            while ($f = $sel2->fetch_assoc()) {  ?>
                        <input disabled type="text" name="name_client" value="<?php echo $f['priority'] ?>" required>

                        <?php  } ?>

                        <label for="hour_price">Descripción</label>

                        <textarea style="height:150px;" name="" id="" cols="60" rows="90"
                            disabled><?php echo $description ?></textarea>

                        <label for="activities">Actividades</label> <br>


                        <table class="centered">
                            <?php
              $i = 1;
              $sel_ot = $con->query("SELECT a.*, b.name, c.series_number, c.id_model, d.name AS model_name
                       FROM tasks_equipments AS a
                       JOIN tasks AS b
                       ON a.id_tasks = b.id
                       JOIN equipment AS c
                       ON a.id_equipment=c.id
                       JOIN model as d
                       ON c.id_model=d.id
                       WHERE number_ot = '$number_ot'"); ?>

                            <tr>
                                <td style="">Número de serie</td>
                                <td>Modelo</td>
                                <td>Tarea</td>
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
                                    <input name="activities[]" type="checkbox" id="check<?php echo $i ?>"
                                        checked="checked" disabled="disabled">
                                    <?php } else { ?>
                                    <input name="activities[]" type="checkbox" id="check<?php echo $i ?>"
                                        disabled="disabled">
                                    <?php } ?>
                                    <label for="check<?php echo $i ?>">
                                        <?php
                      echo $f['name'];
                      ?>
                                    </label>
                                </td>
                            </tr>
                            <?php $i++;
              } ?>
                        </table>



                        <label for="com">Comentario del técnico</label>
                        <?php
            $sel2 = $con->query("SELECT DISTINCT comment FROM  tasks_equipments WHERE number_ot='$number_ot'");
            while ($f = $sel2->fetch_assoc()) {
            ?>
                        <textarea style="height:150px;" name="com" id="" cols="60" rows="90"
                            disabled><?php echo $comment ?></textarea>


                        <?php  } ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="row">
    <div class=" col s12">
        <p style="color:grey;">Documento de orden</p>
        <div class="card horizontal" style="padding: 10px;">

            <a
                href="../ots/orden_de_trabajo.php?location=<?php echo $location ?>&contact_name=<?php echo $contact_name ?>&comment=<?php echo $comment ?>&client_name=<?php echo $client_name ?>&leader=<?php echo $leader ?>&description=<?php echo $description ?>&ot_number=<?php echo $number_ot ?>&id=<?php echo $id ?>&created_at=<?php echo $created_at ?>&name_branch=<?php echo $name_branch ?>&type=<?php echo $type ?>&status=<?php echo $status ?>">
                <button type="=submit" class="btn light-blue darken-2" name="button" id="btn-guardar">Generar</button>

            </a>

        </div>
    </div>

</div>


<div class="row">
    <div class=" col s12">
        <p style="color:grey;">Atender orden</p>
        <div class="card horizontal" style="padding: 10px;">
            <?php
      if ($status == 'iniciada' || $status == 'pendiente') {
      ?>
            <a href="resume_ot.php?id=<?php echo $id ?>"> <button type="=submit" class="btn light-blue darken-2"
                    name="button" id="btn-guardar">Atender</button></a>

            <?php } else { ?>
            <p>Orden finalizada</p>
            <?php } ?>

        </div>
    </div>

</div>
<div class="row">
    <div class=" col s12">
        <p style="color:grey;">Comentarios</p>
        <div class="card horizontal" style="overflow:auto;">

            <div class="card-stacked">
                <div class="card-content">
                    <form action="" method="post">
                        <table class="excel responsive-table" border="1">
                            <thead>
                                <th>Comentario</th>
                                <th>editar</th>

                            </thead>
                            <?php
              $sel2 = $con->query("SELECT comment FROM ots WHERE id = '$id' ");


              while ($f = $sel2->fetch_assoc()) {  ?>
                            <tr>
                                <td><?php echo $f['comment'] ?></td>
                                <td><a href="update_comment.php?id=<?php echo $id ?>"
                                        class="btn-floating light-blue darken-2"><i
                                            class="material-icons">settings_applications</i></a></td>
                            </tr>

                            <?php  } ?>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include '../extend/scripts.php'; ?>


</body>

</html>