<!DOCTYPE html>
<html lang="en" style="height: 100%!important;">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('/')}}dist/css/adminlte.min.css?v=<?php echo time();?>">
  <link rel="stylesheet" href="{{asset('/')}}css/main.css?v=<?php echo time();?>">
</head>
<body style="background-color: #f9f9f9;" class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" style="height: 100vh;">
  <div class="wrapper-form-login p-3 rounded" style="background-color: #ffff;display: block; width: 30%; position:fixed; top: 50%;  left: 50%;  transform: translate(-50%, -50%); ">
        <img src="{{asset('/')}}img/logonyotopng.png" alt="Logo Las Nyoto" width="100" height="100%" style="display:block;margin:10px auto;">
        </img>
        @if (Session::get('status')=="fail")
            <div class="alert alert-danger" role="alert">
            {{Session::get('message')}}
            </div>

        @elseif(Session::get('status')=="success")
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
            </div>
        @endif
    
        <form method="post" action="/createregistration" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama</label>
            <input type="name" class="form-control" id="name" name="name"  required>
            <!--<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>-->
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email"aria-describedby="emailHelp" required>
          <!--<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>-->
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">No. HP</label>
          <input type="text" class="form-control" id="no_hp" name="no_hp" required>
          <!--<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>-->
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
        </div>
       <!-- <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>-->
        <button type="submit" class="btn bg-blue">Register</button>
      </form>
      <a style="text-center;margin:10px auto;display:block;" class="btn btn-block " href="/login" > Sudah memiliki Akun ? <b>Login</b></a>
  </div>
</div>
<!-- ./wrapper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
