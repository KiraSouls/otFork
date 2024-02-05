<?php include '../extend/header.php';

$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM ejecucion_ot WHERE ot = '$id' ");
while ($f = $sel->fetch_assoc()) {
    $ot = $f['ot'];
    $dia = $f['dia'];
    $hora = $f['hora'];    
}
?>

<div class="row">
    <div class="col s12">
        <p style="color:grey;">Agendar OT #<?php echo $ot ?></p>
        <div class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <form class="form" action="../reclamo/up_agendamiento.php" method="post">
                        <div class="row">
                            <div class="col s3">
                                <label for="client">OT</label>
                                <input type="number" min="0" name="ot" value="<?php echo $ot?>">
                            </div>

                            <div class="col s3">
                                <label for="client">Día</label>
                                <input type="date" min="0" name="dia" value="<?php echo date('Y-m-d', strtotime($dia))?>">
                            </div>

                            <div class="col s3">
                                <label for="client">Hora</label>
                                <input type="time" min="0" name="hora" value="<?php echo $hora?>">
                            </div>
                        </div> <br>

                        <input type="text" name="id" value="<?php echo $id ?>" hidden>

                        <button type="=submit" class="btn light-blue darken-2" name="button" id="btn-guardar">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../extend/scripts.php'; ?>

<script>
    //Carga de Sucursal en base a cliente
    $(document).ready(function() {
        $("#client").change(function() {
            $("#client option:selected").each(function() {
                id_client = $(this).val();
                $.post("../ots/data.php", {
                    id_client: id_client
                }, function(data) {
                    $("#branch").html(data);
                });
            });
        })
    });

    //Cargar contacto en base a sucursal
    $(document).ready(function() {
        $("#branch").change(function() {
            $("#branch option:selected").each(function() {
                id_branch = $(this).val();

                //   $.post("data_equipment.php", {id_branch: id_branch
                //   }, function(data) {
                //         $("#equipment").html(data);
                //         $("#equipment2").html(data);
                //         $("#equipment3").html(data);
                //         $("#equipment4").html(data);
                //         $("#equipment5").html(data);
                //         $("#equipment6").html(data);
                //         $("#equipment7").html(data);
                //         $("#equipment8").html(data);
                //         $("#equipment9").html(data);
                //         $("#equipment10").html(data);
                //   });
                $.post("../ots/data_contact.php", {
                    id_branch: id_branch
                }, function(data) {
                    $("#contact").html(data);
                });
            });
        })
    });

</script>

</body>

</html>
