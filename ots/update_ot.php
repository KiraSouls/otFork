<?php include '../extend/header.php';
$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM ots WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
   $id_client = $f['id_client'];
   $id_branch = $f['id_branch'];
   $id_contact = $f['id_contact'];
   $type = $f['type'];
   $hours = $f['hours'];
   $id_service = $f['id_service'];
   $leader = $f['leader'];
   $number = $f['number'];
   $description = $f['description'];
   $hours = $f['hours'];
   $priority = $f['priority'];
   $status = $f['status'];
   $tipo_visitas = $f['tipo_visitas'];

   $detalle = $f['detalle'];
   $accesorios = $f['accesorios'];
   $rayones = $f['rayones'];
   $rupturas = $f['rupturas'];
   $tornillos = $f['tornillos'];
   $gomas = $f['gomas'];
   $estado = $f['estado'];
   $observaciones = $f['observaciones'];
   $cargador = $f['cargador'];
   $cable = $f['cable'];
   $adaptador = $f['adaptador'];
   $bateria = $f['bateria'];
   $pantalla = $f['pantalla'];
   $teclado = $f['teclado'];
   $drum = $f['drum'];
   $toner = $f['toner'];
}

$sel_subline = $con->query("SELECT id_sublinea FROM services WHERE id='$id_service'");
while ($fu = $sel_subline->fetch_assoc()) {

   $service_line = $fu['id_sublinea'];
}

$sel_id_line = $con->query("SELECT id_line FROM sub_linea WHERE id='$service_line'");
while ($g = $sel_id_line->fetch_assoc()) {
   $id_line = $g['id_line'];
}

?>

<div class="row">
   <div class="col s12">
      <h5>Detalles de orden #<?php echo $number ?></h5>
      <div class="card horizontal">

         <div class="card-stacked">
            <div class="card-content">
               <form class="form" action="up_ot.php" method="post">
                  <div class="row">

                     <div class="col s3">
                        <label for="client">Cliente</label>
                        <select class="browser-default" name="client" id="client" required>
                           <option value="0" selected>Selecciona un cliente</option>
                           <?php
                           $sel2 = $con->query("SELECT * FROM clients");
                           while ($f = $sel2->fetch_assoc()) {  ?>
                              <option value='<?php echo $f['id'] ?>' <?php if ($f['id'] == $id_client) {
                                                                        echo 'selected';
                                                                     } ?>> <?php echo $f['name'] ?></option>
                           <?php  } ?>
                        </select>
                     </div>

                     <div class="col s7">
                        <label for="branch">Sucursal</label>
                        <select class="browser-default" name="branch" id="branch" required>
                           <?php
                           $sel2 = $con->query("SELECT * FROM branches");
                           while ($f = $sel2->fetch_assoc()) {  ?>
                              <option value='<?php echo $f['id'] ?>' <?php if ($f['id'] == $id_branch) {
                                                                        echo 'selected';
                                                                     } ?>> <?php echo $f['branch_name'] ?>-<?php echo $f['location'] ?></option>
                           <?php  } ?>
                        </select>

                     </div>

                     <div class=" col s2">
                        <label for="contact">Contacto</label>
                        <select class="browser-default" name="contact" id="contact" required>
                           <?php
                           $sel2 = $con->query("SELECT * FROM contacts");
                           while ($f = $sel2->fetch_assoc()) {  ?>
                              <option value='<?php echo $f['id'] ?>' <?php if ($f['id'] == $id_contact) {
                                                                        echo 'selected';
                                                                     } ?>> <?php echo $f['contact_name'] ?></option>
                           <?php  } ?>
                        </select>
                     </div>
                  </div> <br>

                  <div class="row">
                     <div class=" col s6">
                        <label for="service">Servicio</label>
                        <select class="browser-default" name="service" id="service" required>
                           <option value="" selected>Selecciona servicio</option>

                           <?php
                           $sel2 = $con->query("SELECT * FROM services ");
                           while ($f = $sel2->fetch_assoc()) {  ?>
                              <option value='<?php echo $f['id'] ?>' <?php if ($f['id'] == $id_service) {
                                                                        echo 'selected';
                                                                     } ?>> <?php echo $f['service_name'] ?></option>
                           <?php  } ?>
                        </select>
                     </div>
                  </div>

                  <div class="row"> <?php
                                    $sel_num_equipment = $con->query("SELECT DISTINCT id_equipment FROM tasks_equipments WHERE number_ot='$number'");
                                    $row = mysqli_num_rows($sel_num_equipment);
                                    while ($f = $sel_num_equipment->fetch_assoc()) {
                                       $id_equipment = $f['id_equipment'];

                                       $sel_dataset = $con->query("SELECT task_set FROM tasks_equipments  WHERE number_ot='$number' AND id_equipment='$id_equipment'");
                                       while ($m = $sel_dataset->fetch_assoc()) {
                                          $dataset = $m['task_set'];
                                       }

                                       $sel4 = $con->query("SELECT series_number, id FROM equipment WHERE id = '$id_equipment'");
                                       $sel_inner = $con->query("SELECT id_model FROM equipment WHERE id = '$id_equipment'");


                                       $sel_id_task = $con->query("SELECT id_tasks FROM tasks_equipments  WHERE id_equipment = '$id_equipment' AND  number_ot='$number' ");
                                       $row_num = mysqli_num_rows($sel_id_task);

                                       while ($k = $sel4->fetch_assoc()) {

                                          $series_number = $k['series_number'];

                                          if ($dataset == 1) {
                                             $dataset = '';
                                          }

                                          while ($u = $sel_inner->fetch_assoc()) {
                                             $id_modelo = $u['id_model'];


                                             $sel_sublinee = $con->query("SELECT id_sublinea FROM model WHERE id = '$id_modelo'");
                                             while ($o = $sel_sublinee->fetch_assoc()) {
                                                $sublinea_id = $o['id_sublinea'];
                                             }

                                             $sel_name = $con->query("SELECT name FROM model WHERE id = '$id_modelo'");
                                             while ($p = $sel_name->fetch_assoc()) {
                                                $model_name = $p['name'];
                                    ?>
                           <?php

                                             }
                                          }
                           ?>
                           <table class="highlight striped" id="dynamic_field">
                              <tr>
                                 <td>
                                    <div id="sublinea" class="col s12 ">
                                       <label for="subline<?php echo $dataset ?>">Sublinea</label>
                                       <select style='width:300px;' class="browser-default" name="subline<?php echo $dataset ?>" id="subline<?php echo $dataset ?>">

                                          <?php
                                          $sel_sublines = $con->query("SELECT * FROM sub_linea  WHERE id_line='$id_line'");
                                          while ($m = $sel_sublines->fetch_assoc()) { ?>
                                             <option value='<?php echo $m['id'] ?>' <?php if ($m['id'] == $sublinea_id) {
                                                                                       echo 'selected';
                                                                                    } ?>><?php echo $m['name'] ?></option>
                                          <?php   } ?>
                                       </select>
                                    </div>
                                 </td>
                                 <td>
                                    <div id="equipo" class="col s12 equipo ">
                                       <label for="equipment">Equipo</label>
                                       <select style='width:300px;' class="browser-default" name="equipment<?php echo $dataset ?>" id="equipment<?php echo $dataset ?>">
                                          <option value='<?php echo $k['id'] ?>'> <?php echo $model_name ?> N° de serie: <?php echo $series_number ?></option>
                                       </select>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="col s12 right">
                                       <label for="task">Tarea</label>
                                       <select style="height:150px;width:300px;" class="browser-default" name="task<?php echo $dataset ?>[]" id="task<?php echo $dataset ?>" multiple>
                                          <?php
                                          $id_equip = $k['id'];
                                          $sel2 = $con->query("SELECT * FROM tasks WHERE id_service='$id_service'");


                                          while ($rr = $sel_id_task->fetch_assoc()) {

                                             while ($p = $sel2->fetch_assoc()) {
                                                $id_p = $p['id'];
                                          ?>
                                                <option value='<?php echo $p['id'] ?>' <?php $sel_s =  $con->query("SELECT * FROM tasks_equipments WHERE number_ot='$number' AND id_equipment='$id_equip' AND id_tasks='$id_p'");
                                                                                       $filas = mysqli_num_rows($sel_s);
                                                                                       if ($filas > 0) {
                                                                                          echo 'selected';
                                                                                       }  ?>> <?php echo $p['name'] ?></option>

                                          <?php
                                             }
                                             $i = 1;
                                          }  ?>
                                       </select>

                                    </div>
                                 </td>
                                 <td>
                                    <div class="col s6 right">
                                       <a id="add" class="btn-floating btn-large waves-effect waves-light light-blue darken-2 right"><i class="material-icons">add</i></a>
                                    </div>
                                 </td>
                              </tr>

                           </table>
                     <?php }
                                    } ?>

                  </div>
                  <div class="row">
                     <div class=" col s6">
                        <label for="participants[]">Técnicos</label>

                        <select style="min-height: 140px;" class="browser-default" name="participants[]" id="participants" required multiple>
                           <?php
                           //Obtine técnicos
                           $sel = $con->query("SELECT DISTINCT tech.name, tech.id
                                                 FROM  services ser
                                                 INNER JOIN techs_services ts ON ts.id_service= '$id_service'
                                                 INNER JOIN techs tech ON tech.id= ts.id_tech");


                           $selparticip = $con->query("SELECT participant_name FROM participants
                     WHERE ot_number=$number");

                           while ($t = $sel->fetch_assoc()) {
                              if (in_array($t['name'], $selparticip->fetch_assoc())) {
                                 echo '<option selected value="' . $t['name'] . '">' . $t['name'] . '</option>';
                              } else {
                                 echo '<option value="' . $t['name'] . '">' . $t['name'] . '</option>';
                              }
                           }
                           ?>
                        </select>

                     </div>
                     <div class=" col s6">
                        <label>Encargado</label>

                        <select class="browser-default" name="leader" id="leader">
                           <option value="" disabled selected>Selecciona un encargado</option>

                           <?php
                           $sel2 = $con->query("SELECT DISTINCT tech.name, tech.id
                       FROM  services ser
                       INNER JOIN techs_services ts ON ts.id_service= '$id_service'
                       INNER JOIN techs tech ON tech.id= ts.id_tech");
                           while ($f = $sel2->fetch_assoc()) {  ?>
                              <option value='<?php echo $f['name'] ?>' <?php if ($f['name'] == $leader) {
                                                                           echo 'selected';
                                                                        } ?>> <?php echo $f['name'] ?></option>
                           <?php  } ?>
                        </select>
                     </div>
                  </div>

                  <div id="det" class="row" style="border:1px solid #cfcfcf">
                     <div class="col s6">
                        <div>
                           <legend>¿El Equipo Posee Detalles?:</legend>
                           <div>
                              <input type="radio" id="detsi" name="deta" value='1' <?php if ($detalle == 1) {
                                                                                       echo 'checked';
                                                                                    } ?> />
                              <label for="detsi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="detno" name="deta" value='0' <?php if ($detalle == 0) {
                                                                                       echo 'checked';
                                                                                    } ?> />

                              <label for="detno">No</label>
                           </div>
                        </div>


                        <div id="rayones" class="row">
                           <div>
                              <legend>¿El Equipo Posee Rayones?:</legend>
                              <div>
                                 <input type="radio" id="raysi" name="raya" value="si" <?php if ($rayones != "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="raysi">Si</label>
                              </div>
                              <div>
                                 <input type="radio" id="rayno" name="raya" value="no" <?php if ($rayones == "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="rayno">No</label>
                              </div>
                              <div>
                                 <textarea required id="area" name="rayones" placeholder="El Equipo presenta..."><?php if ($rayones == "") {
                                                                                                                     echo "No Aplica";
                                                                                                                  } else {
                                                                                                                     echo $rayones;
                                                                                                                  } ?></textarea>
                              </div>
                           </div>
                        </div>


                        <div id="rupturas" class="row">
                           <div>
                              <legend>¿El Equipo Posee Rupturas?:</legend>
                              <div>
                                 <input type="radio" id="rupsi" name="rup" value="si" <?php if ($rupturas != "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="rupsi">Si</label>
                              </div>
                              <div>
                                 <input type="radio" id="rupno" name="rup" value="no" <?php if ($rupturas == "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="rupno">No</label>
                              </div>
                              <div>
                                 <textarea required id="area2" name="rupturas" placeholder="El Equipo presenta..."><?php if ($rupturas == "") {
                                                                                                                        echo "No Aplica";
                                                                                                                     } else {
                                                                                                                        echo $rupturas;
                                                                                                                     } ?></textarea>
                              </div>
                           </div>
                        </div>


                        <div id="tornillos" class="row">
                           <div>
                              <legend>¿El Equipo Posee Todos Los Tornillos De Su Carcasa?:</legend>
                              <div>
                                 <input type="radio" id="torsi" name="torn" value="si" <?php if ($tornillos != "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="torsi">Si</label>
                              </div>
                              <div>
                                 <input type="radio" id="torno" name="torn" value="no" <?php if ($tornillos == "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="torno">No</label>
                              </div>
                              <div>
                                 <textarea required id="area3" name="tornillos" placeholder="El Equipo presenta..."><?php if ($tornillos == "") {
                                                                                                                        echo "No Aplica";
                                                                                                                     } else {
                                                                                                                        echo $tornillos;
                                                                                                                     } ?></textarea>
                              </div>
                           </div>
                        </div>

                        <div id="gomas" class="row">
                           <div>
                              <legend>¿El Equipo Posee Las Gomas De La Base En Buen Estado?:</legend>
                              <div>
                                 <input type="radio" id="gosi" name="go" value="si" <?php if ($gomas != "No Aplica") {
                                                                                       echo 'checked';
                                                                                    } ?> />
                                 <label for="gosi">Si</label>
                              </div>
                              <div>
                                 <input type="radio" id="gono" name="go" value="no" <?php if ($gomas == "No Aplica") {
                                                                                       echo 'checked';
                                                                                    } ?> />
                                 <label for="gono">No</label>
                              </div>
                              <div>
                                 <textarea required id="area4" name="gomas" placeholder="El Equipo presenta..."><?php if ($gomas == "") {
                                                                                                                     echo "No Aplica";
                                                                                                                  } else {
                                                                                                                     echo $gomas;
                                                                                                                  } ?></textarea>
                              </div>
                           </div>
                        </div>

                        <div class="row" id="estado">
                           <div class="input-field col s12 ">
                              <textarea name="estado" placeholder="El Equipo (si/no) enciende..." class="materialize-textarea" data-length="800"><?php if ($estado == "") {
                                                                                                                                                      echo "No Aplica";
                                                                                                                                                   } else {
                                                                                                                                                      echo $estado;
                                                                                                                                                   } ?></textarea>
                              <label for="estado">Indique El Estado Del Equipo</label>
                           </div>
                        </div>

                        <div class="row" id="obs">
                           <div class="input-field col s12 ">
                              <textarea name="obs" class="materialize-textarea" placeholder="El Equipo presenta..." data-length="800"><?php if ($observaciones == "") {
                                                                                                                                          echo "No Aplica";
                                                                                                                                       } else {
                                                                                                                                          echo $observaciones;
                                                                                                                                       } ?></textarea>
                              <label for="obs">Observaciones Adicionales</label>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div id="acc" class="row " style="border: 1px solid #cfcfcf">
                     <div class="col s6">
                        <div>
                           <legend>¿El Equipo Posee Accesorios:</legend>
                           <div>
                              <input type="radio" id="accsi" name="acce" value='1' <?php if ($accesorios == 1) {
                                                                                       echo 'checked';
                                                                                    } ?> />
                              <label for="accsi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="accno" name="acce" value='0' <?php if ($accesorios == 0) {
                                                                                       echo 'checked';
                                                                                    } ?> />
                              <label for="accno">No</label>
                           </div>
                        </div>

                        <div id="cargador" class="row ">
                           <div>
                              <legend>¿El Equipo Posee Cargador?:</legend>
                              <div>
                                 <input type="radio" id="carsi" name="carga" value="si" <?php if ($cargador != "No Aplica") {
                                                                                             echo 'checked';
                                                                                          } ?> />
                                 <label for="carsi">Si</label>
                              </div>
                              <div>
                                 <input type="radio" id="carno" name="carga" value="no" <?php if ($cargador == "No Aplica") {
                                                                                             echo 'checked';
                                                                                          } ?> />
                                 <label for="carno">No</label>
                              </div>
                              <div>
                                 <textarea required id="area5" name="cargador" placeholder="N° de serie del accesorio"><?php if ($cargador == "") {
                                                                                                                           echo "No Aplica";
                                                                                                                        } else {
                                                                                                                           echo $cargador;
                                                                                                                        } ?></textarea>
                              </div>
                           </div>
                        </div>

                        <div id="cable" class="row ">
                           <div>
                              <legend>¿El Equipo Posee Cable de Poder?:</legend>
                              <div>
                                 <input type="radio" id="podersi" name="poder" value="si" <?php if ($cable != "No Aplica") {
                                                                                             echo 'checked';
                                                                                          } ?> />
                                 <label for="podersi">Si</label>
                              </div>
                              <div>
                                 <input type="radio" id="poderno" name="poder" value="no" <?php if ($cable == "No Aplica") {
                                                                                             echo 'checked';
                                                                                          } ?> />
                                 <label for="poderno">No</label>
                              </div>
                              <div>
                                 <textarea required id="area6" name="cable" placeholder="Ingrese observaciones"><?php if ($cable == "") {
                                                                                                                     echo "No Aplica";
                                                                                                                  } else {
                                                                                                                     echo $cable;
                                                                                                                  } ?></textarea>
                              </div>
                           </div>
                        </div>

                        <div id="adaptador" class="row ">
                           <div>
                              <legend>¿El Equipo Posee Adaptador de Poder?:</legend>
                              <div>
                                 <input type="radio" id="adasi" name="adapt" value="si" <?php if ($adaptador != "No Aplica") {
                                                                                             echo 'checked';
                                                                                          } ?> />
                                 <label for="adasi">Si</label>
                              </div>
                              <div>
                                 <input type="radio" id="adano" name="adapt" value="no" <?php if ($adaptador == "No Aplica") {
                                                                                             echo 'checked';
                                                                                          } ?> />
                                 <label for="adano">No</label>
                              </div>
                              <div>
                                 <textarea required id="area7" name="adaptador" placeholder="Ingrese observaciones"><?php if ($adaptador == "") {
                                                                                                                        echo "No Aplica";
                                                                                                                     } else {
                                                                                                                        echo $adaptador;
                                                                                                                     } ?></textarea>
                              </div>
                           </div>
                        </div>

                        <div id="bateria" class="row ">
                           <div>
                              <legend>¿El Equipo Posee Batería?:</legend>
                              <div>
                                 <input type="radio" id="batsi" name="bat" value="si" <?php if ($bateria != "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="batsi">Si</label>
                              </div>
                              <div>
                                 <input type="radio" id="batno" name="bat" value="no" <?php if ($bateria == "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="batno">No</label>
                              </div>
                              <div>
                                 <textarea required id="area8" name="bateria" placeholder="N° de serie del accesorio"><?php if ($bateria == "") {
                                                                                                                           echo "No Aplica";
                                                                                                                        } else {
                                                                                                                           echo $bateria;
                                                                                                                        } ?></textarea>
                              </div>
                           </div>
                        </div>

                        <div id="pantalla" class="row ">
                           <div>
                              <legend>¿El Equipo Posee Pantalla En Mal Estado?:</legend>
                              <div>
                                 <input type="radio" id="pansi" name="pant" value="si" <?php if ($pantalla != "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="pansi">Si</label>
                              </div>
                              <div>
                                 <input type="radio" id="panno" name="pant" value="no" <?php if ($pantalla == "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="panno">No</label>
                              </div>
                              <div>
                                 <textarea required id="area9" name="pantalla" placeholder="El Equipo presenta..."><?php if ($pantalla == "") {
                                                                                                                        echo "No Aplica";
                                                                                                                     } else {
                                                                                                                        echo $pantalla;
                                                                                                                     } ?></textarea>
                              </div>
                           </div>
                        </div>

                        <div id="teclado" class="row ">
                           <div>
                              <legend>¿El Equipo Posee Teclado en Mal Estado?:</legend>
                              <div>
                                 <input type="radio" id="tecsi" name="tec" value="si" <?php if ($teclado != "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="tecsi">Si</label>
                              </div>
                              <div>
                                 <input type="radio" id="tecno" name="tec" value="no" <?php if ($teclado == "No Aplica") {
                                                                                          echo 'checked';
                                                                                       } ?> />
                                 <label for="tecno">No</label>
                              </div>
                              <div>
                                 <textarea required id="area10" name="teclado" placeholder="El Equipo presenta..."><?php if ($teclado == "") {
                                                                                                                        echo "No Aplica";
                                                                                                                     } else {
                                                                                                                        echo $teclado;
                                                                                                                     } ?></textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div id="toner" class="row ">
                     <div class="col s6">
                        <legend>¿El Equipo Posee Toner?:</legend>
                        <div>
                           <input type="radio" id="tonsi" name="ton" value="si" <?php if ($toner != "No Aplica") {
                                                                                    echo 'checked';
                                                                                 } ?> />
                           <label for="tonsi">Si</label>
                        </div>
                        <div>
                           <input type="radio" id="tonno" name="ton" value="no" <?php if ($toner == "No Aplica") {
                                                                                    echo 'checked';
                                                                                 } ?> />
                           <label for="tonno">No</label>
                        </div>
                        <div>
                           <textarea required id="area11" name="toner" placeholder="El Equipo presenta..."><?php if ($toner == "") {
                                                                                                               echo "No Aplica";
                                                                                                            } else {
                                                                                                               echo $toner;
                                                                                                            } ?></textarea>
                        </div>
                     </div>
                  </div>

                  <div id="drum" class="row ">
                     <div class="col s6">
                        <legend>¿El Equipo Posee Drum?:</legend>
                        <div>
                           <input type="radio" id="drsi" name="dru" value="si" <?php if ($drum != "No Aplica") {
                                                                                    echo 'checked';
                                                                                 } ?> />
                           <label for="drsi">Si</label>
                        </div>
                        <div>
                           <input type="radio" id="drno" name="dru" value="no" <?php if ($drum == "No Aplica") {
                                                                                    echo 'checked';
                                                                                 } ?> />
                           <label for="drno">No</label>
                        </div>
                        <div>
                           <textarea required id="area12" name="drum" placeholder="El Equipo presenta..."><?php if ($drum == "") {
                                                                                                               echo "No Aplica";
                                                                                                            } else {
                                                                                                               echo $drum;
                                                                                                            } ?></textarea>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="input-field col s12">
                        <textarea id="description" name="description" class="materialize-textarea" data-length="800"><?php if ($description == "") {
                                                                                                                        echo "No Aplica";
                                                                                                                     } else {
                                                                                                                        echo $description;
                                                                                                                     } ?></textarea>
                        <label for="description">Descripción De Orden</label>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col s6">
                        <label for="hours">Horas</label>

                        <input type="number" min="0" name="hours" value="<?php if ($hours == "") {
                                                                              echo '0';
                                                                           } else {
                                                                              echo $hours;
                                                                           } ?>">

                     </div>
                  </div>

                  <div class="row">
                     <div class="col s6">
                        <label for="priority">Prioridad</label>
                        <select class="browser-default" name="priority" id="priority">

                           <option value="alta" <?php if ($priority == 'alta') {
                                                   echo 'selected';
                                                } ?>>Alta</option>

                           <option value="media" <?php if ($priority == 'media') {
                                                      echo 'selected';
                                                   } ?>>Media</option>

                           <option value="baja" <?php if ($priority == 'baja') {
                                                   echo 'selected';
                                                } ?>>Baja</option>

                        </select>

                     </div>
                  </div>

                  <div class="row">
                     <div class="col s12">
                        <label for="type">Tipo de Orden</label>

                        <p>
                           <input id="interna" type="radio" name="type" value="Laboratorio" <?php if ($type == 'Laboratorio') {
                                                                                                echo 'checked';
                                                                                             } ?> />
                           <label for="interna">Laboratorio</label>
                        </p>

                        <p>
                           <input id="externa" type="radio" name="type" value="Terreno" <?php if ($type == 'Terreno') {
                                                                                             echo 'checked';
                                                                                          } ?> />
                           <label for="externa">Terreno</label>
                        </p>
                        <p>
                           <input id="remota" type="radio" name="type" value="Remota" <?php if ($type == 'Remota') {
                                                                                          echo 'checked';
                                                                                       } ?> />
                           <label for="remota">Remota</label>
                        </p>

                     </div>
                  </div>

                  <div class="row">
                     <div class=" col s12">
                        <label for="type">Tipo de Visita</label>
                        <p>
                           <input id="pre" type="radio" name="typev" value="Presencial" <?php if ($tipo_visitas == 'Presencial') {
                                                                                             echo 'checked';
                                                                                          } ?> />
                           <label for="pre">Presencial</label>
                        </p>

                        <p>
                           <input id="em" type="radio" name="typev" value="Emergencia" <?php if ($tipo_visitas == 'Emergencia') {
                                                                                          echo 'checked';
                                                                                       } ?> />
                           <label for="em">Emergencia</label>
                        </p>

                        <p>
                           <input id="sr" type="radio" name="typev" value="Soporte Remoto" <?php if ($tipo_visitas == 'Soporte Remoto') {
                                                                                                echo 'checked';
                                                                                             } ?> />
                           <label for="sr">Soporte Remoto</label>
                        </p>

                        <p>
                           <input id="ht" type="radio" name="typev" value="Horas Tecnicas" <?php if ($tipo_visitas == 'Horas Tecnicas') {
                                                                                                echo 'checked';
                                                                                             } ?> />
                           <label for="ht">Horas Técnicas</label>
                        </p>

                     </div>
                  </div>


                  <div class="row">
                     <div class="col s12">
                        <label for="status">Estado</label>
                        <select class="browser-default" name="status">

                           <option value="iniciada" <?php if ($status == 'iniciada') {
                                                         echo 'selected';
                                                      } ?>>iniciada</option>

                           <option value="pendiente" <?php if ($status == 'pendiente') {
                                                         echo 'selected';
                                                      } ?>>pendiente</option>

                           <option value="finalizada" <?php if ($status == 'finalizada') {
                                                         echo 'selected';
                                                      } ?>>finalizada</option>

                        </select>
                     </div>
                  </div>


                  <input type="text" name="id" value="<?php echo $id ?>" hidden>

                  <input type="text" name="number_ot" value="<?php echo $number ?>" hidden>

                  <button type="=submit" class="btn light-blue darken-2" name="button" id="btn-guardar">Guardar</button>


               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div class=" col s12">
      <p style="color:grey;">Actividades</p>
      <div class="card horizontal">

         <div class="card-stacked">
            <div class="card-content">
               <form action="up_client.php" method="post">
                  <table class="excel striped responsive-table" border="1">
                     <thead>
                        <th>Nombre</th>
                        <th>Duración</th>
                        <th class="borrar">Eliminar</th>
                     </thead>
                     <?php
                     $sel2 = $con->query("SELECT * FROM activities WHERE id_ot = '$id' ");


                     while ($f = $sel2->fetch_assoc()) {  ?>
                        <tr>
                           <td><?php echo $f['name'] ?></td>
                           <td><?php echo $f['hours'] ?> Horas</td>
                           <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar la actividad?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_activity.php?id=<?php echo $f['id'] ?>&idx=<?php echo $id ?>'; } else { location.href='update_ot.php?id=<?php echo $id ?>';} })"><i class="material-icons">clear</i></a></td>
                        </tr>

                     <?php  } ?>

                     <a href="add_activity.php?id=<?php echo $id ?>&id_service=<?php echo $id_service ?>"> + Agregar</a>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include '../extend/scripts.php'; ?>

<script>
   $(document).ready(function() {
      // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
      $('.modal-trigger').leanModal();
   });


   $(document).ready(function() {
      $("#client").change(function() {
         $("#client option:selected").each(function() {
            id_client = $(this).val();
            $.post("data.php", {
               id_client: id_client
            }, function(data) {
               $("#branch").html(data);
            });
         });
      })
   });


   $(document).ready(function() {
      $("#brand_name").change(function() {
         $("#brand_name option:selected").each(function() {
            id_brand = $(this).val();
            $.post("data_model.php", {
               id_brand: id_brand
            }, function(data) {
               $("#model_name").html(data);
            });
         });
      })
   });


   $(document).ready(function() {
      $("#subline").change(function() {
         $("#subline option:selected").each(function() {
            id_subline = $(this).val();
            $.post("data_subline_equipment.php", {
               id_subline: id_subline,
               id_branch: id_branch
            }, function(data) {
               $("#equipment").html(data);
            });
         });
      })
   });


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
            $.post("data_contact.php", {
               id_branch: id_branch
            }, function(data) {
               $("#contact").html(data);
            });
         });
      })
   });


   $(document).ready(function() {
      $("#service").change(function() {
         $("#service option:selected").each(function() {
            id_service = $(this).val();
            $.post("data_tech.php", {
               id_service: id_service
            }, function(data) {
               $("#leader").html(data);
               $("#participants").html(data);
            });


            $.post("data_service.php", {
               id_service: id_service
            }, function(data) {
               $("#task").html(data);
               $("#task2").html(data);
               $("#task3").html(data);
               $("#task4").html(data);
               $("#task5").html(data);
               $("#task6").html(data);
               $("#task7").html(data);
               $("#task8").html(data);
               $("#task9").html(data);
               $("#task10").html(data);
            });

            //Esta funcion despliega los elementos visualmente dependiendo de si es servicio o laboratorio (0-1)

            $.post("data_equipment_show.php", {
               id_service: id_service
            }, function(data) {

               if (data == 1) {

                  var element = document.getElementById("sublinea");
                  element.classList.remove("hide");

                  var element = document.getElementById("equipo");
                  element.classList.remove("hide");

                  var element = document.getElementById("tarea");
                  element.classList.remove("hide");

                  var element = document.getElementById("det");
                  element.classList.remove("hide");

                  var element = document.getElementById("acc");
                  element.classList.remove("hide");

                  var element = document.getElementById("toner");
                  element.classList.add("hide");

                  var element = document.getElementById("drum");
                  element.classList.add("hide");

                  var element2 = document.getElementById("add");
                  element2.classList.remove("hide");

               }
               if (data == 0) {
                  var element = document.getElementById("sublinea");
                  element.classList.add("hide");

                  var element = document.getElementById("equipo");
                  element.classList.add("hide");

                  var element = document.getElementById("tarea");
                  element.classList.remove("hide");

                  var element = document.getElementById("det");
                  element.classList.add("hide");

                  var element = document.getElementById("acc");
                  element.classList.add("hide");

                  var element = document.getElementById("toner");
                  element.classList.add("hide");

                  var element = document.getElementById("drum");
                  element.classList.add("hide");

                  var element3 = document.getElementById("add");
                  element3.classList.add("hide");

               }
               if (data == 2) {
                  var element = document.getElementById("sublinea");
                  element.classList.remove("hide");

                  var element = document.getElementById("equipo");
                  element.classList.remove("hide");

                  var element = document.getElementById("tarea");
                  element.classList.remove("hide");

                  var element = document.getElementById("det");
                  element.classList.remove("hide");

                  var element = document.getElementById("acc");
                  element.classList.remove("hide");

                  var element = document.getElementById("toner");
                  element.classList.remove("hide");

                  var element = document.getElementById("drum");
                  element.classList.remove("hide");

                  var element2 = document.getElementById("add");
                  element2.classList.remove("hide");
               }
            });


            $.post("data_line.php", {
               id_service: id_service,
               id_branch: id_branch
            }, function(data) {
               $("#equipment").html(data);
               $("#equipment2").html(data);
               $("#equipment3").html(data);
               $("#equipment4").html(data);
               $("#equipment5").html(data);
               $("#equipment6").html(data);
               $("#equipment7").html(data);
               $("#equipment8").html(data);
               $("#equipment9").html(data);
               $("#equipment10").html(data);
            });


            $.post("data_subline.php", {
               id_service: id_service
            }, function(data) {
               $("#subline").html(data);
               $("#subline2").html(data);
               $("#subline3").html(data);
               $("#subline4").html(data);
               $("#subline5").html(data);
               $("#subline6").html(data);
               $("#subline7").html(data);
               $("#subline8").html(data);
               $("#subline9").html(data);
               $("#subline10").html(data);
            });


         });
      })
   });


   $(document).ready(function() {
      var i = 1;

      $('#add').click(function() {
         $.post("data_line.php", {
            id_service: id_service,
            id_branch: id_branch
         }, function(data) {

            for (f = 0; f < i; f++) {
               $("#equipment" + i).html(data);
            }

         });


         $.post("data_service.php", {
            id_service: id_service
         }, function(data) {
            for (f = 0; f < i; f++) {
               $("#task" + i).html(data);
            }
         });


         $.post("data_subline.php", {
            id_service: id_service
         }, function(data) {
            for (f = 0; f < i; f++) {
               $("#subline" + i).html(data);
            }
         });


         i++;
         $(document).ready(function() {
            $("#subline" + i).change(function() {
               $("#subline" + i + " option:selected").each(function() {
                  id_subline = $(this).val();
                  $.post("data_subline_equipment.php", {
                     id_subline: id_subline,
                     id_branch: id_branch
                  }, function(data) {
                     $("#equipment" + i).html(data);
                  });
               });
            })
         });


         document.getElementById('e_count').value = i;
         document.getElementById('equipo').value = i;

         $('#dynamic_field').
         append('<tr id="row' + i + '"> <td> <div id="sublinea' + i + '" class="col s12 " > <label for="subline' + i + '">Sublinea</label> <select style="width:300px;" class="browser-default" name="subline' + i + '" id="subline' + i +
            '" > </select> </div> </td><td> <div id="equipo" class="col s12 equipo" > <label for="equipment' + i + '">Equipo</label> <select style="width:300px;" class="browser-default" name="equipment' + i + '" id="equipment' + i +
            '"> </select> </div> </td> <td> <div class = "col s12 right"> <label for="task">Tarea</label> <select style="height:150px;width:300px;" class="browser-default" name="task' + i + '[]" id="task' + i +
            '" multiple> </select> </div> </td> <td> <div class = "col s6 right"> <a name="remove" id="' + i + '" class="btn-floating btn-large waves-effect waves-light light-blue darken-2 right btn_remove"><i class="material-icons">remove</i></a> </div> </td> </tr>'
         );
      });

      $(document).on('click', '.btn_remove', function() {
         var button_id = $(this).attr("id");
         $('#row' + button_id + '').remove();
      });
   });
</script>


</body>

</html>
