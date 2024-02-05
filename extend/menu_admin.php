<?php
$sel = $con->query("SELECT * FROM notifications WHERE status=1 ORDER BY id DESC LIMIT 5");
$row = mysqli_num_rows($sel);
?>




<ul id="slide-out" class="side-nav fixed">
<li>
  <div class="userView">
    <div class="background bg-dark">
    </div>
    <a  href="" ><img src="../img/user-pic.png" class="" width="100"></a>
    <div class = "notification">
  <a href = "#">
  <div class ="notBtn" href = "#">
    <!--Number supports double digets and automaticly hides itself when there is nothing between divs -->
    <div class = "number"></div>
    <i style="colo:white;margin-left:99px;" class="fas fa-bell right awhite"></i>
      <div class = "box">
        <div class = "display">
          <div class = "nothing">
            <i class="fas fa-child stick"></i>
          </div>
          <div class = "cont"><!-- Fold this div and try deleting evrything inbetween -->
          <?php  while ($f = $sel->fetch_assoc()) { ?>
            <div class = "sec new">
               <a href = "">

               <div class ="txt"> <?php echo $f['notification_name'] ?></div>
              <div class ="txt sub"><?php echo $f['created_at'] ?></div>
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

<a href="" class="white-text" style="margin-top: -33px;padding-left: 50px;"> <?php echo $_SESSION['email']  ?>  </a>
      <a href="" class="white-text" style="margin-top: -33px;padding-left: 50px;">ADMINISTRADOR</a> <br>   
  </div>  
<li><a class="menu_active" id="ordenes" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;margin-top: 0px;border-left: 4px solid #0288d1;" href="../ots/"><i style="color: white;" class="material-icons">assignment</i>Ordenes</a></li>
  <li><a id="clientes" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../users/users.php"><i style="color: white;" class="material-icons">account_circle</i>Clientes</a></li>
  <li><a id="proveedores" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../providers/"><i style="color: white;" class="material-icons">local_shipping</i>Proveedores</a></li>
  <li><a id="repuestos" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../replacements/"><i style="color: white;" class="material-icons">build</i>Repuestos</a></li>
  <li><a id="especialistas" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../techs/"><i style="color: white;" class="material-icons">person_pin_circle</i>Técnicos</a></li>
  <li><a id="usuarios" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../home/"><i style="color: white;" class="material-icons">supervisor_account</i>Usuarios</a></li>
  <li><a id="servicios" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../services/"><i style="color: white;" class="material-icons">device_hub</i>Servicios</a></li>
  <li><a id="" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../equipments/"><i style="color: white;" class="material-icons">computer</i>Equipos</a></li>
  <li><a id="" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../config/"><i style="color: white;" class="material-icons">settings</i>Parametros</a></li>
  <li><a id="" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../reclamo/index.php"><i style="color: white;" class="material-icons">verified</i>Reclamos</a></li>
  <li><a id="" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../reclamo/seguimiento.php"><i style="color: white;" class="material-icons">list</i>Seguimiento</a></li>
  <li><a id="" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../reclamo/agendamiento.php"><i style="color: white;" class="material-icons">event</i>Agendamiento</a></li>
  <li><a id="" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../reclamo/contratos.php"><i style="color: white;" class="material-icons">article</i>Contrato</a></li>
  <li><a id="" style="font-weight: 400;letter-spacing: 1px; color: white; font-size: 16px;" href="../login/salir.php"><i style="color: white;" class="material-icons">power_settings_new</i>Salir</a></li>
  <h1 class="" style="position:fixed;bottom: 25px;"> <img src="http://www.scinformatica.cl/universal/img/logo-small.png" alt="" hidden></h1> 
 
    </ul>

<nav style='background-color:#181d2b' class='navnav '><a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a></nav>
