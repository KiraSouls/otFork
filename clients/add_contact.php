<?php include '../extend/header.php';
$id = htmlentities($_GET['id']);
?>
<div class="row" style="padding-top:10px;">
   <div class="col s12">
    <div class="card">
      <div class="card-content">
       <span class="card-title">Agregar contacto</span>
       <form class="form" action="ins_contact.php" method="post">

         <div class="input-field">
                   <input type="text" name="contact_name" required  id="name" title="Nombre" required>
                   <label for="contact_name">Nombre:</label>
         </div>
          <div class="input-field">
                   <input type="text" name="contact_email" required  id="email" title="email" required>
                   <label for="contact_email">Correo:</label>
         </div>
         <div class="input-field">
                  <input type="text" name="contact_phone" required  id="phone" title="telefono" required>
                  <input type="text" name="id" value="<?php echo $id ?>" hidden>
                  <label for="contact_phone">Teléfono:</label>
          </div>
          <div class="input-field">
                  <input type="text" name="contact_department" required >
                  <label for="contact_department">Departamento o área</label>
          </div>
          <div class="input-field">
                  <input type="text" name="contact_charge" required  id="charge" title="sucursal" required>
                  <label for="contact_charge">Cargo:</label>
          </div>
         <button type="=submit"  class="btn light-blue darken-2" name="button" id="btn-guardar">Guardar</button>

       </form>
      </div>
   </div>
  </div>
</div>


<?php include '../extend/scripts.php'; ?>

   </body>
   </html>
