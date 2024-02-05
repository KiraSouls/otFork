<?php include '../extend/header.php';

$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM contacts WHERE id = '$id' ");

if ($f = $sel->fetch_assoc()) {
  $name = $f['contact_name'];
  $phone = $f['phone'];
  $idx = $f['id'];
  $department = $f['department'];
  $charge = $f['charge'];
  $email = $f['email'];
}
?>

<div class="row">
  <div class="col s12">
    <p style="color:grey;">Detalles de contacto</p>
    <div class="card horizontal">
      <div class="card-stacked">
        <div class="card-content">
          <form  action="update_contact.php" method="post">
            <label for="location">Nombre</label>
            <input type="text" name="contact_name" value="<?php echo isset($name) ? $name : '' ?>">

            <label for="phone">Teléfono</label>
            <input type="text" name="contact_phone" value="<?php echo isset($phone) ? $phone : '' ?>">

            <label for="department">Departamento o área</label>
            <input type="text" name="contact_department" value="<?php echo isset($department) ? $department : '' ?>">

            <label for="charge">Cargo</label>
            <input type="text" name="contact_charge" value="<?php echo isset($charge) ? $charge : '' ?>">

            <label for="email">Email</label>
            <input type="text" name="contact_email" value="<?php echo isset($email) ? $email : '' ?>">
            
            <input type="text" name="id" value="<?php echo $idx ?>" hidden>
            <input type="text" name="idx" value="<?php echo $id ?>" hidden>
            <button type="submit" class="btn light-blue darken-2">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
