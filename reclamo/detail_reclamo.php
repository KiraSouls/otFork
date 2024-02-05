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
        <p style="color:grey;">Detalles de Reclamo</p>
        <div style='overflow:auto;' class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <form action="up_tech.php" method="post">
                        <label for="name_clients"> Nombre del cliente</label>
        <?php $sel2 = $con->query("SELECT * FROM clients WHERE id='$id_client'");
                     while ($f = $sel2->fetch_assoc()) {
                         $client_name = $f['name']  ?>
                        <input disabled type="text" name="client_name" value="<?php echo $f['name']?>" required>
        <?php  } ?>

                        <label for="email">Sucursal</label>
        <?php $sel2 = $con->query("SELECT * FROM branches WHERE id='$id_branch'");
                     while ($f = $sel2->fetch_assoc()) { 
                        $name_branch = $f['branch_name'];
                         $branch_name = $f['location']    ?>
                        <input disabled type="text" name="branch_name" value="<?php echo $f['branch_name']?>-<?php echo $f['location']?>" required>
        <?php  } ?>

                        <label for="rut">Contacto</label>
        <?php $sel2 = $con->query("SELECT * FROM contacts WHERE id='$id_contact'");
                     while ($f = $sel2->fetch_assoc()) {  
                         $contact_name = $f['contact_name']  ?>
                        <input disabled type="text" name="contact_name" value="<?php echo $f['contact_name']?>" required>
        <?php  } ?>

                        <label for="rut">N° OT</label>
                        <input disabled type="text" name="contact_name" value="<?php echo $ot?>" required>

                        <label for="rut">Factura</label>
                        <input disabled type="text" name="contact_name" value="<?php echo $factura?>" required>

                        <label for="phone">Tipo</label>
        <?php $sel2 = $con->query("SELECT * FROM estado_reclamo WHERE id='$status'");
                     while ($f = $sel2->fetch_assoc()) { 
                         $type = $f['description']   ?>
                        <input disabled type="text" name="type" value="<?php echo $f['description']?>" required>
        <?php  } ?>

                        <label for="hour_price">Encargado</label>
        <?php $sel2 = $con->query("SELECT * FROM techs WHERE id='$id_tech'");
                     while ($f = $sel2->fetch_assoc()) {  ?>
                        <input disabled type="text" name="name_client" value="<?php echo $f['name']?>" required>
        <?php  } ?>

                        <label for="hour_price">Fecha del Incidente</label>
                        <input disabled type="text" name="name_client" value="<?php echo substr($fecha_incidente, 0, 10) ?>" required>

                        <label for="hour_price">Descripción</label>
                        <textarea style="height:150px;" name="" id="" cols="60" rows="90" disabled><?php echo $description?></textarea>
                        
                        <label for="hour_price">Posibles Causas</label>
                        <textarea style="height:150px;" name="" id="" cols="60" rows="90" disabled><?php echo $causa?></textarea>
                        
                        <label for="hour_price">Solución</label>
                        <textarea style="height:150px;" name="" id="" cols="60" rows="90" disabled><?php echo $solution?></textarea>
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
            <a href="orden_de_trabajo.php?location=<?php echo $location?>&contact_name=<?php echo $contact_name?>&comment=<?php echo $comment?>&client_name=<?php echo $client_name?>&leader=<?php echo $leader?>&description=<?php echo $description?>&ot_number=<?php echo $number_ot?>&id=<?php echo $id?>&created_at=<?php echo $created_at?>&type=<?php echo $type?>&status=<?php echo $status?>&name_branch=<?php echo $name_branch?>"> <button type="=submit" class="btn light-blue darken-2" name="button" id="btn-guardar">Generar</button>
            </a>
        </div>
    </div>
</div>

<?php include '../extend/scripts.php'; ?>

</body>

</html>
