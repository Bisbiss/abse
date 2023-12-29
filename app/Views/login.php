<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk Sistem!</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url().'/assets/plugins/fontawesome-free/css/all.min.css' ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url().'/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url().'/assets/css/adminlte.min.css' ?>">
  <link rel="icon" type="image/x-icon" href="/assets/img/yasfika.png">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <img src="<?= base_url().'/assets/img/yasfika.png' ?>" class="img-fluid">
        <span class="h1">Sistem Absensi</span>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Silahkan masuk ke sistem!</p>
      <?php
        if (session()->getFlashdata('message')) {
            echo "<div class='alert alert-danger'><marquee>".session()->getFlashdata('message')."</marquee></div>";
        }
      ?>
      <form action="/login" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url().'/assets/plugins/jquery/jquery.min.js' ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url().'/assets/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url().'/assets/js/adminlte.min.js' ?>"></script>
</body>
</html>
