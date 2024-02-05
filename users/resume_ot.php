<?php include '../extend/header_tech.php';



$id = $_GET['id'];

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
  $number_ot = $f['number'];
}
?>


<div class="row">
    <div style="    margin-top: 0px;" class="card">
        <nav class="nav-extended" style="background-color: #181d2b;">
            <div class="nav-content">
                <ul class="tabs tabs-transparent">
                    <li class="tab"><a href="#test1">Finalizar ot</a></li>
                    <li class="tab"><a class="active" href="#test2">Avances</a></li>
                </ul>
            </div>
        </nav>

        <div id="test1" class="col s12">
            <div class="row">
                <div class="col s12">
                    <p>Finalizar orden</p>
                    <div class="card horizontal">

                        <div class="card-stacked">
                            <div class="card-content">
                                <form action="up_resume_ot.php" method="post">

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
                                                    checked="checked">
                                                <?php } else { ?>
                                                <input name="activities[]" type="checkbox" id="check<?php echo $i ?>">
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
                                    <br>


                                    <input type="text" name="number_ot" value="<?php echo $number_ot ?>" hidden>

                                    <input type="text" name="id" value="<?php echo $id ?>" hidden>

                                    <div class="input-field col s12">
                                        <input id="comment" type="text" class="materialize-textarea validate"
                                            name="comment">
                                        <label for="comment">Comentario</label>
                                    </div>


                                    <button type="submit" class="btn light-blue darken-2">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="test2" class="col s12">
            <div class="row">
                <div class="col s12">
                    <p>Agregar avance</p>
                    <div class="card horizontal">

                        <div class="card-stacked">
                            <div class="card-content">

                                <div class="input-field col s12">
                                    <textarea name="comment" id="tech_comment" class="materialize-textarea"
                                        placeholder="Comentario de avance"></textarea>
                                </div>
                                <button type="button" class="btn light-blue darken-2"
                                    onclick="insAvance(<?php echo $number_ot ?>)">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <?php $sel = $con->query("SELECT * FROM advances WHERE ot_number=$number_ot");
  $row = mysqli_num_rows($sel);
  ?>

    <div class="row">
        <div class="col s12">
            <div style='min-height: 320px;' class="card">
                <div class="card-content">
                    <form action="excel.php" method="post" target="_blank" id="exportar">
                        <span class="card-title">Avances(<?php echo $row ?>)</span>
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
                            <td><a href="update_advance.php?id=<?php echo $f['id'] ?>"
                                    class="btn-floating light-blue darken-2"><i
                                        class="material-icons">settings_applications</i></a></td>
                            <td class="borrar"><a href="#" class="btn-floating red"
                                    onclick="swal({ title:'Esta seguro que desea eliminar el avance?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_advance.php?id=<?php echo     $f['id'] ?>'; } else { location.href='resume_ot.php?id=<?php echo     $id ?>';} })"><i
                                        class="material-icons">clear</i></a></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include '../extend/scripts.php'; ?>
</body>

</html>


<script>
function insAvance(number_ot) {

    comment = document.getElementById('tech_comment').value;

    if (comment == "") {

        Swal.fire({

            title: 'Campo Vacio'
        })


    } else if (comment != "") {


        url = 'ins_advance.php'
        data = {
            ot_number: number_ot,
            comment: comment
        }

        $.ajax({

            type: "POST",

            url: url,

            data: data

        }).done(function(data) {

            console.log(data);
            Swal.fire({
                icon: 'success',
                title: 'Se Ingreso el Avance'
            }).then(function() {
                window.location.href = 'ot.php?id=<?php echo $id ?>'
            });


        });


    }

}
</script>