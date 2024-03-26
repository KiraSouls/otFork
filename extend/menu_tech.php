<?php
$sel = $con->query("SELECT * FROM notifications WHERE status=1 ORDER BY id DESC LIMIT 5");
$row = mysqli_num_rows($sel);

if ($_SESSION['email'] == null && $_SESSION['password'] == null) {
  header("Location: ../");
  exit;
} else
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
            <i style="color:white;margin-left:99px;" class="fas fa-bell right awhite"></i>
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
    <?php if ($_SESSION['rol'] == 'ESPECIALISTA') { ?>
      <a href="" class="white-text" style="margin-top: -33px;padding-left: 50px;">TÉCNICO</a> <br>
    <?php  } ?>
    </div>
  </li>
  <li><a class="menu_active" id="ordenes" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;margin-top: 0px;border-left: 4px solid #0288d1;" href="../users/tech.php"><i style="color: white;" class="material-icons">assignment</i>Mis Ordenes</a></li>
  <li><a id="repuestos" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href=""><i style="color: white;" class="material-icons">build</i>Repuestos</a></li>
  <li><a id="" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../reclamo/agendamiento_tech.php"><i style="color: white;" class="material-icons">event</i>Agendamiento</a></li>
  <li><a id="" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../login/salir.php"><i style="color: white;" class="material-icons">power_settings_new</i>Salir</a></li>
  <h1 class="" style="position:fixed;bottom: 25px;"> <img src="http://www.scinformatica.cl/universal/img/logo-small.png" alt=""></h1>

</ul>

<nav style='background-color:#181d2b' class='navnav '><a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a></nav>
