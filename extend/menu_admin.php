<?php
$sel = $con->query("SELECT * FROM notifications WHERE status=1 ORDER BY id DESC LIMIT 5");
$row = mysqli_num_rows($sel);
?>




<ul id="slide-out" class="side-nav fixed">
  <li>
    <div class="userView">
      <div class="background bg-dark">
      </div>
      <a href=""><img src="../img/user-pic.png" class="" width="100"></a>
      <div class="notification">
        <a href="#">
          <div class="notBtn" href="#">
            <!--Number supports double digets and automaticly hides itself when there is nothing between divs -->
            <div class="number"></div>
            <i style="colo:white;margin-left:99px;" class="fas fa-bell right awhite"></i>
            <div class="box">
              <div class="display">
                <div class="nothing">
                  <i class="fas fa-child stick"></i>
                </div>
                <div class="cont"><!-- Fold this div and try deleting evrything inbetween -->
                  <?php while ($f = $sel->fetch_assoc()) { ?>
                    <div class="sec new">
                      <a href="">

                        <div class="txt"> <?php echo $f['notification_name'] ?></div>
                        <div class="txt sub"><?php echo $f['created_at'] ?></div>
                      </a>
                    </div>
                  <?php } ?>






                </div>
              </div>
            </div>
          </div>
      </div>
      </a>
    </div>

    <a href="" class="white-text" style="margin-top: -33px;padding-left: 50px;"> <?php echo $_SESSION['email']  ?> </a>
    <a href="" class="white-text" style="margin-top: -33px;padding-left: 50px;">ADMINISTRADOR</a> <br>
    </div>

    <?php
    function active($currect_page)
    {
      $url_array = explode('/', $_SERVER['REQUEST_URI']);
      $url = end($url_array);
      if ($currect_page == $url) {
        echo 'activo';
      }
    }
    ?>

    <style type="text/css">
      .activo {
        color: white !important;
        background-color: #0288d1;
        font-weight: 400;
        letter-spacing: 1px;
        font-size: 16px
      }
    </style>



  <li><a class="<?php active('index.php'); ?> id=" ordenes" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../ots/index.php"><i style="color: white;" class="material-icons">assignment</i>Ordenes</a></li>
  <li><a class="<?php active('users.php'); ?> id=" clientes" style=" font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../users/users.php"><i style="color: white;" class="material-icons">account_circle</i>Clientes</a></li>
  <li><a class="<?php active('index-providers.php'); ?> id=" proveedores" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../providers/index-providers.php"><i style="color: white;" class="material-icons">local_shipping</i>Proveedores</a></li>
  <li><a class="<?php active('index-replacements.php'); ?> id=" repuestos" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../replacements/index-replacements.php"><i style="color: white;" class="material-icons">build</i>Repuestos</a></li>
  <li><a class="<?php active('index-techs.php'); ?> id=" especialistas" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../techs/index-techs.php"><i style="color: white;" class="material-icons">person_pin_circle</i>Técnicos</a></li>
  <li><a class="<?php active('index-home.php'); ?> id=" usuarios" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../home/index-home.php"><i style="color: white;" class="material-icons">supervisor_account</i>Usuarios</a></li>
  <li><a class="<?php active('index-services.php'); ?> id=" servicios" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../services/index-services.php"><i style="color: white;" class="material-icons">device_hub</i>Servicios</a></li>
  <li><a class="<?php active('index-equipments.php'); ?> id="" style=" font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../equipments/index-equipments.php"><i style="color: white;" class="material-icons">computer</i>Equipos</a></li>
  <li><a class="<?php active('index-config.php'); ?> id="" style=" font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../config/index-config.php"><i style="color: white;" class="material-icons">settings</i>Parametros</a></li>
  <li><a class="<?php active('index-reclamo.php'); ?> id="" style=" font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../reclamo/index-reclamo.php"><i style="color: white;" class="material-icons">verified</i>Reclamos</a></li>
  <li><a class="<?php active('seguimiento.php'); ?> id="" style=" font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../reclamo/seguimiento.php"><i style="color: white;" class="material-icons">list</i>Seguimiento</a></li>
  <li><a class="<?php active('agendamiento.php'); ?> id="" style=" font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../reclamo/agendamiento.php"><i style="color: white;" class="material-icons">event</i>Agendamiento</a></li>
  <li><a class="<?php active('contratos.php'); ?> id="" style=" font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../reclamo/contratos.php"><i style="color: white;" class="material-icons">article</i>Contrato</a></li>
  <li><a class="<?php active('salir.php'); ?> id="" style=" font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../login/salir.php"><i style="color: white;" class="material-icons">power_settings_new</i>Salir</a></li>
  <h1 class="" style="position:fixed;bottom: 25px;"> <img src="http://www.scinformatica.cl/universal/img/logo-small.png" alt="" hidden></h1>

</ul>

<nav style='background-color:#181d2b' class='navnav '><a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a></nav>
