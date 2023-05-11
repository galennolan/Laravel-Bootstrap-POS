
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="center">
        <div class="col-lg-6 d-none d-lg-block "></div>
        <div class="col-lg-20">
        <div class="p-5">
        <div class="text-center">
        <h1 class="h4 text-gray-900 mb4">Sistem Informasi Akuntansi<br>Fakultas Teknik dan Informatika<br>
        <br><img src="http://127.0.0.1:8000/asset/img/logo_ubsi.png"width="160"></h1>
        </div>
        <form method="POST" action="{{ route('login') }}"> @csrf
<div class="form-group row">
 <label for="email" class="col-md-12 col-formlabel text-md-left">{{ __('E-Mail Address') }}</label>
 <div class="col-md-12">
 <input id="email" type="email" class="form-control @error('email') isinvalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
 @error('email')
 <span class="invalidfeedback" role="alert">
 <strong>{{ $message }}</strong>
 </span>
 @enderror
 </div>
 </div>
<div class="form-group row">
 <label for="password" class="col-md-12 colform-label text-md-left">{{ __('Password') }}</label>
 <div class="col-md-12">
 <input id="password" type="password" class="form-control @error('password') isinvalid @enderror" name="password" required autocomplete="currentpassword">
 @error('password')
 <span class="invalidfeedback" role="alert">
 <strong>{{ $message }}</strong>
 </span>
 @enderror
 </div>
 </div>
<div class="form-group row">
 <div class="col-md-12 offset-md-12">
 <div class="form-check">
 <input class="form-checkinput" type="checkbox" name="remember" id="remember" {{ old('remember') ?'checked' : '' }}>
 <label class="form-checklabel" for="remember"> {{ __('Remember Me') }}
 </label>
 </div>
 </div>
 </div>
<div class="form-group row mb-0">
 <div class="col-md-12 offset-md-12">
 <button type="submit" class="btn btn-primary">
 {{ __('Login') }}
 </button>
 @if (Route::has('password.request'))
    <a class="btn btn-link" href="{{ route('password.request') }}">
 {{ __('Forgot Your Password?') }}
 </a>
 @endif
 </div>
 </div>
 </form>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>

    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>