<?php include '../extend/header.php'; ?>

       <div class="row">
          <div class="col s12">
            <div class="card">
                <div class="card-content">
                <h1>Editar perfil</h1>
                </div>
                <div class="card-tabs">
                  <ul class="tabs tabs-fixed-width">
                    <li class="tab"><a href="#datos" class="active">Datos</a></li>
                    <li class="tab"><a  href="#pass">Contraseña</a></li>
                  </ul>
                </div>
                <div class="card-content grey lighten-4">
                  <div id="datos">
                    <form class="form" action="up_perfil.php" method="post" enctype="multipart/form-data">
                      <div class="input-field">
                        <input type="email" name="correo" required autofocus id="correo" value="<?php echo $_SESSION['email'] ?>" title="Correo electronico">
                        <label for="correo">E-mail:</label>
                      </div>
                      <div class="validacion"></div>

                      <div class="input-field">
                        <input type="text" name="nombre" title="Nombre del usuario" id="nombre" onblur="may(this.value, this.id)" pattern="[A-Z/s ]+" value="<?php echo $_SESSION['name'] ?>">
                        <label for="nombre">Nombre completo:</label>
                      </div>

                      <button type="=submit"  class="btn black" name="button" >Editar<i class="material-icons">send</i></button>

                    </form>
                  </div>
                  <div id="pass">
                    <form class="form" action="up_pass.php" method="post" enctype="multipart/form-data">

                      <div class="validacion"></div>

                      <div class="input-field">
                        <input type="password" name="pass1" title="Entre 8 y 15 caracteres" pattern="[A-Za-z0-9]{8,15}" id="pass1">
                        <label for="pass1">Contraseña:</label>

                        <div class="input-field">
                          <input type="password"  title="Entre 8 y 15 caracteres" pattern="[A-Za-z0-9]{8,15}" id="pass2">
                          <label for="pass2">Verificar Contraseña:</label>
                      </div>
                      <button type="=submit"  class="btn black" name="button" id="btn-guardar">Editar<i class="material-icons">send</i></button>

                    </form>
                  </div>
                </div>
              </div>

         </div>
       </div>

<?php include '../extend/scripts.php'; ?>
<script src="../js/validacion.js"></script>

</body>
</html>
