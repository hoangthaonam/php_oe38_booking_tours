<!DOCTYPE html>
<html>
<head>
    <title></title>
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
      <link href="{{asset('assets/admin/css/login.css')}}" rel="stylesheet">

</head>
<body>
<form class="login-form" action="{{route('admin.login')}}" method="POST">
  {{ csrf_field() }}
  <p class="login-text">
    Admin
  </p>
  <input type="text" name="username" class="login-username" autofocus="true" required="true" placeholder="Username" />
  <p class="help is-danger">{{ $errors->first('username') }}</p>
  <input type="password" name="password" class="login-password" required="true" placeholder="Password" />
  <p class="help is-danger">{{ $errors->first('password') }}</p>
  <input type="submit" id="btn_login" name="Login" value="Login" class="login-submit" />
  <div> @include('Common.Error') </div>
</form>
<div class="underlay-photo"></div>
<div class="underlay-black"></div>
</body>
</html>
