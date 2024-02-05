<?php include '../extend/header.php';

$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM reclamo WHERE id = '$id' ");
while ($f = $sel->fetch_assoc()) {
    $id_client = $f['id_client'];
    $id_branch = $f['id_branch'];
    $id_contact = $f['id_contact'];    
    $ot = $f['ot'];
    $factura = $f['factura'];
    $id_users= $f['id_users'];
    $id_tech = $f['id_tech'];
    $description = $f['description'];
    $solution = $f['solution'];
    $causa= $f['causa'];
    $status= $f['status'];
    $fecha_incidente= $f['fecha_incidente'];
    $created_at= $f['created_at'];
}
?>

<div class="row">
    <div class="col s12">
        <p style="color:grey;">Detalles de orden #<?php echo $id ?></p>
        <div class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <form class="form" action="../reclamo/up_reclamo.php" method="post">
                        <div class="row">
                            <div class="col s3">
                                <label for="client">Cliente</label>
                                <select class="browser-default" name="client" id="client" required>
                                    <option value="0" selected>Selecciona un cliente</option>
                                    <?php $sel2 = $con->query("SELECT * FROM clients");
            while ($f = $sel2->fetch_assoc()) {  ?>
                                    <option value='<?php echo $f['id'] ?>' <?php if($f['id']==$id_client) { echo 'selected'; } ?>> <?php echo $f['name'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>

                            <div class="col s7">
                                <label for="branch">Sucursal</label>
                                <select class="browser-default" name="branch" id="branch" required>
                                    <?php $sel2 = $con->query("SELECT * FROM branches");
            while ($f = $sel2->fetch_assoc()) {  ?>
                                    <option value='<?php echo $f['id'] ?>' <?php if($f['id']==$id_branch) { echo 'selected'; } ?>> <?php echo $f['branch_name'] ?>-<?php echo $f['location'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>

                            <div class=" col s2">
                                <label for="contact">Contacto</label>
                                <select class="browser-default" name="contact" id="contact" required>
                                    <?php $sel2 = $con->query("SELECT * FROM contacts");
                          while ($f = $sel2->fetch_assoc()) {  ?>
                                    <option value='<?php echo $f['id'] ?>' <?php if($f['id']==$id_contact) { echo 'selected'; } ?>> <?php echo $f['contact_name'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                        </div> <br>

                        <div class="row">
                            <div class=" col s4">
                                <label for="service">N° OT</label>
                                <input type="number" min="0" name="ot" value="<?php echo $ot;?>">
                            </div>
                            <div class=" col s4">
                                <label for="service">Factura</label>
                                <input type="number" min="0" name="factura" value="<?php echo $factura; ?>">
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col s3">
                                <label>Técnico</label>
                                <select class="browser-default" name="tecnico" id="tecnico">
                                    <option value="0">Seleccione un Técnico</option>
                                    <?php $sel2 = $con->query("select * from techs"); 
            while ($f = $sel2->fetch_assoc()) {  
                                    if($f['id'] == $id_tech){ ?>
                                    <option value="<?php echo $f['id']; ?>" selected><?php echo $f['name']; ?></option>
                                    <?php }else{ ?>
                                    <option value="<?php echo $f['id']; ?>"><?php echo $f['name']; ?></option>
                                    <?php } ?>
                                    <option value="<?php echo $f['id']; ?>"><?php echo $f['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col s3">
                                <label>Estado</label>
                                <select class="browser-default" name="estado" id="estado">
                                    <option value="0">Seleccione un Estado</option>
                                    <?php $sel2 = $con->query("select * from estado_reclamo"); 
            while ($f = $sel2->fetch_assoc()) {  
                                    if($f['id'] == $status){ ?>
                                    <option value="<?php echo $f['id']; ?>" selected><?php echo $f['description']; ?></option>
                                    <?php }else{ ?>
                                    <option value="<?php echo $f['id']; ?>"><?php echo $f['description']; ?></option>
                                    <?php } ?>                
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col s3">
                                <label>Fecha del Incidente</label>
                                <input type="date" min="0" name="fecha" value="<?php echo date('Y-m-d', strtotime($fecha_incidente)) ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="description" name="description" class="materialize-textarea" data-length="120"><?php echo $description ?></textarea>
                                <label for="description">Descripción</label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="causa" name="causa" class="materialize-textarea" data-length="120"><?php echo $causa ?></textarea>
                                <label for="description">Posibles Causas</label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="solucion" name="solucion" class="materialize-textarea" data-length="120"><?php echo $solution ?></textarea>
                                <label for="description">Solución</label>
                            </div>
                        </div>

                        <input type="text" name="id" value="<?php echo $id ?>" hidden>

                        <input type="text" name="number" value="<?php echo $id_users ?>" hidden>

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
