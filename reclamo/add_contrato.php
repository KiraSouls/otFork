<?php include '../extend/header.php';
$number = $con-> real_escape_string(htmlentities($_GET['number']));
?>

<div class="row" style="padding-top:10px;">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Registro Contrato</span>
                <form class="form" action="../reclamo/ins_contrato.php" id="add_ot" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col s4">
                            <label for="client">Cliente</label>
                            <select class="browser-default" name="client" id="client" required>
                                <option value="0" selected>Selecciona un cliente</option>
                                <?php
                $sel2 = $con->query("SELECT * FROM clients");
                while ($f = $sel2->fetch_assoc()) {  ?>
                                <option value='<?php echo $f['id'] ?>'> <?php echo $f['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col s7">
                            <label for="branch">Sucursal</label>
                            <select class="browser-default" name="branch" id="branch" required>
                            </select>
                        </div>

                        <!--<div class=" col s3">
                            <label for="contact">Contacto</label>
                            <select class="browser-default" name="contact" id="contact" required>
                            </select>
                        </div>-->
                    </div> <br>

                    <div class="row">
                        <div class=" col s4">
                            <label for="service">Tipo Contrato</label>
                            <input type="text" min="0" name="tipo" maxlength="50" max="50">
                        </div>
                        <div class=" col s4">
                            <label for="service">Nombre Archivo</label>
                            <input type="text" min="0" maxlength="50" max="50" name="name">
                        </div>
                        <div class="col s3">
                            <label>Archivo</label>
                            <input type="file" name="archivo">
                        </div>
                    </div>

                    <input id="number" type="text" name="number" value="<?php echo $number ?>" hidden>

                    <button class="btn light-blue darken-2" name="btn-guardar" id="btn-guardar">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../extend/scripts.php'; ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<script>
    $(document).ready(function() {
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();
    });

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
