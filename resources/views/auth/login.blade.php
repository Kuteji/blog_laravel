


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name')}} | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <a href="/">{{ config('app.name')}}</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
     
      <form method="POST" action="{{ route('login') }}">
        @csrf <!--Genera u token para verificar el origen y evitar la suplantacion de identidad-->
        <div class="form-group row">
          <div class="col col-md-12">
              <input id="email" 
                  type="email" 
                  class="form-control
                   @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="tu email">

              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>
      <div class="form-group row">
        <div class="col col-md-12">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="tu contraseña">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
        <div class="row">
          <div class="col col-md-6">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <div class="col col-md-6">
            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Login') }}
            </button>
        </div>
        </div>
        <div class="row justify-content-center">
          <div class="col col-md-10">
              <div class="text-center m-4">
                  <a href="#">Olvidaste tu contraseña ?</a>
              </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="adminlte/js/adminlte.min.js"></script>

</body>
</html>

