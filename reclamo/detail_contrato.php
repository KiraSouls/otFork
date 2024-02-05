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
?>

<div class="row">
    <div class="col s12">
        <p style="color:grey;">Detalles Contrato</p>
        <div style='overflow:auto;' class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <form action="up_tech.php" method="post">
                        <label for="name_clients"> Nombre del cliente</label>
        <?php $sel2 = $con->query("SELECT * FROM clients WHERE id='$client'");
                     while ($f = $sel2->fetch_assoc()) {
                         $client_name = $f['name']  ?>
                        <input disabled type="text" name="client_name" value="<?php echo $f['name']?>" required>
        <?php  } ?>

                        <label for="email">Sucursal</label>
        <?php $sel2 = $con->query("SELECT * FROM branches WHERE id='$branche'");
                     while ($f = $sel2->fetch_assoc()) { 
                        $name_branch = $f['branch_name'];
                         $branch_name = $f['location']    ?>
                        <input disabled type="text" name="branch_name" value="<?php echo $f['branch_name']?>-<?php echo $f['location']?>" required>
        <?php  } ?>

                        <!--<label for="rut">Contacto</label>
        <?php $sel2 = $con->query("SELECT * FROM contacts WHERE id='$id_contact'");
                     while ($f = $sel2->fetch_assoc()) {  
                         $contact_name = $f['contact_name']  ?>
                        <input disabled type="text" name="contact_name" value="<?php echo $f['contact_name']?>" required>
        <?php  } ?>-->

                        <label for="rut">Tipo Contrato</label>
                        <input disabled type="text" name="contact_name" value="<?php echo $type?>" required>

                        <label for="rut">Nombre Archivo</label>
                        <input disabled type="text" name="contact_name" value="<?php echo $filename?>" required>

                        <label for="phone">Ubicación </label>
                        <input disabled type="text" name="type" value="<?php echo $location?>" required>
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
            <a href="../reclamo/contrato.php?id=<?php echo $id; ?>" target="_blank"> <button type="=submit" class="btn light-blue darken-2" name="button" id="btn-guardar">Generar</button>
            </a>
        </div>
    </div>
</div>

<?php include '../extend/scripts.php'; ?>

</body>

</html>
