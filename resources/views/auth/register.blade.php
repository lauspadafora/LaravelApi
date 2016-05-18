<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Api</title>
    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('production/css/custom.css') }}" rel="stylesheet">
  </head>
  <body style="background:#F7F7F7;">
    <div class="">
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>
      <div id="wrapper">
        <div id="login" class=" form">
          <section class="login_content">
            <form role="form" method="POST" action="{{ url('/register') }}">
              {!! csrf_field() !!}
              <h1>Crear Cuenta</h1>
              <div>
                <input type="text" class="form-control" placeholder="Nombre" required="" name="name"/>
              </div>             
              <div>
                <input type="email" class="form-control" placeholder="Correo Electrónico" required="" name="email"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Contraseña" required="" name="password"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Repetir contraseña" required="" name="password_confirmation"/>
              </div>
              <div>                
                <button class="btn btn-default submit" type="submit">Crear Cuenta</button>
              </div>
              <div class="clearfix"></div>
              <div class="separator">
                <p class="change_link">¿Ya tienes una cuenta?
                  <a href="{{ url('/login') }}" class="to_register"> Inicia sesión </a>
                </p>
                <div class="clearfix"></div>
                <br />
                <div>                  
                  <p>©2016 Todos los derechos reservados.</p>
                </div>
              </div>
            </form>
          </section>
        </div>       
      </div>
    </div>
  </body>
</html>



