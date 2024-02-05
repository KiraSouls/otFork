<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/materialize.css">
  <link rel="stylesheet" href="css/main.css">
  <meta name="viewport" content= "width=device-width, initial-scale=1.0"> 
</head>

<body>
  <div class="section"></div>
  <main>
    <section class="center">
      <div class="container">
        <div class="z-depth-1 withe lighten-4 row  login-card">

          <form class="col s12" action="login/" method="post">
            <div class='row'>
              <div class='col s12'>
                <img class="responsive-img img"  src="img/q.jpg" />
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='email' id='usuario' placeholder='Correo' required="required" />
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='password' id='password' required="required" placeholder='Contraseña' suggested: "current-password" />
              </div>
              <label style='float: right;'>
                                <a class='blue-text' href='#!'><b>¿Olvidaste tu contraseña?</b></a>
                            </label>
            </div>

            <br />
            <section class="center">
              <div class='row'>
                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect login'>Entrar</button>
              </div>
            </section>
          </form>
        </div>
      </div>
    </section>
  </main>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>

</html>