<?php include '../extend/header.php'; ?>

       <div class="row">
          <div class="col s12">
           <div class="card">
             <div class="card-content">
              <span class="card-title">Selecciona un campo para filtrar</span>
              <form class="form" action="filtro.php" method="post" >

                <select class="" name="filtro" required>
                  <option value="todos" selected>Todos los usuarios</option>
                  <option value="club">Usuario CLUB FIKA</option>
                  <option value="convenio">Usuario CONVENIO</option>
                  <option value="estudiante">Estudiantes</option>
                  <option value="casa">Dueña de casa</option>
                </select><br>

                <button  type="submit" class="btn black" "button">Filtrar</button>

              </form>
             </div>
          </div>
         </div>
       </div>



<?php include '../extend/scripts.php'; ?>
</body>
</html>
