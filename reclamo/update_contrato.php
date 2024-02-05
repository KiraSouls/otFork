<?php include '../extend/header.php';

$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM contrato WHERE id = '$id' ");
while ($f = $sel->fetch_assoc()) {
    $type = $f['type'];
    $filename = $f['filename'];
    $location = $f['location'];    
    $client = $f['client'];
    $branche = $f['branche'];
}

$sel = $con->query("SELECT * FROM clients WHERE id = '$client' ");
while ($f = $sel->fetch_assoc()) {
    $name = $f['name'];
}
?>

<div class="row">
    <div class="col s12">
        <p style="color:grey;">Detalles Contrato #<?php echo $id ?></p>
        <div class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <form class="form" action="../reclamo/up_contrato.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col s4">
                                <label for="client">Cliente</label>
                                <select class="browser-default" name="client" id="client" required>
                                    <option value="0" selected>Selecciona un cliente</option>
                                    <?php $sel2 = $con->query("SELECT * FROM clients");
            while ($f = $sel2->fetch_assoc()) {  ?>
                                    <option value='<?php echo $f['id'] ?>' <?php if($f['id']==$client) { echo 'selected'; } ?>> <?php echo $f['name'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>

                            <div class="col s7">
                                <label for="branch">Sucursal</label>
                                <select class="browser-default" name="branch" id="branch" required>
                                    <?php $sel2 = $con->query("SELECT * FROM branches");
            while ($f = $sel2->fetch_assoc()) {  ?>
                                    <option value='<?php echo $f['id'] ?>' <?php if($f['id']==$branche) { echo 'selected'; } ?>> <?php echo $f['branch_name'] ?>-<?php echo $f['location'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!--<div class=" col s3">
                                <label for="contact">Contacto</label>
                                <select class="browser-default" name="contact" id="contact" required>
                                    <?php $sel2 = $con->query("SELECT * FROM contacts");
                          while ($f = $sel2->fetch_assoc()) {  ?>
                                    <option value='<?php echo $f['id'] ?>' <?php if($f['id']==$id_contact) { echo 'selected'; } ?>> <?php echo $f['contact_name'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>-->
                        </div><br>

                        <div class="row">
                            <div class=" col s4">
                            <label for="service">Tipo Contrato</label>
                            <input type="text" min="0" name="tipo" maxlength="50" max="50" value="<?php echo $type;?>">
                        </div>
                        <div class=" col s4">
                            <label for="service">Nombre Archivo</label>
                            <input type="text" min="0" maxlength="50" max="50" name="name" value="<?php echo $filename;?>">
                        </div>
                        <div class="col s3">
                            <label>Archivo</label>
                            <input type="file" name="archivo" id="archivo">
                        </div>
                        </div><br>

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
