<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url("assets/template/plugins/fontawesome-free/css/all.min.css") ?>">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("assets/template/dist/css/adminlte.min.css") ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="<?= base_url('assets/css/fonts.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("assets/template/plugins/select2/css/select2.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/template/plugins/sweetalert2/sweetalert2.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/template/plugins/toastr/toastr.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">

    <script src="<?= base_url('assets/js/plugins/vue.js') ?>"></script>
    <script type="text/javascript">
        window.App = {
            "baseUrl": "<?= base_url() ?>",
            "removeDOM": "",
        };
    </script>
</head>
<body class="hold-transition login-page">
<div class="login-box" id="login_page">
  <div class="login-logo">
    <img src="<?=base_url('assets/img/bravehearts_logo.jpg')?>" width="15%">
    <a href="#"><b>Bravehearts<br>Martial Arts Institute</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <h3 style="text-align:center;">- - - LOGIN - - -</h3>
      <p class="login-box-msg">Sign in to start your session</p>

      <form @submit.prevent="checkUser">
        <div class="input-group mb-3">
          <input type="text" class="form-control" v-model="userdata.username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" v-model="userdata.password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>

        <hr>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new user account</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?= base_url("assets/template/plugins/jquery/jquery.min.js") ?>"></script>
  <!-- Bootstrap -->
  <script src="<?= base_url("assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/plugins/sweetalert.min.js") ?>"></script>
  <script src="<?= base_url("assets/template/plugins/select2/js/select2.full.min.js") ?>"></script>
  <!-- AdminLTE -->
  <script src="<?= base_url("assets/template/dist/js/adminlte.js") ?>"></script>
  <script src="<?= base_url('assets/js/plugins/axios.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/vue-tables-2.min.js') ?>"></script>

  <script src="<?= base_url("assets/template/plugins/sweetalert2/sweetalert2.min.js") ?>"></script>
  <script src="<?= base_url('assets/template/plugins/toastr/toastr.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/script.js') ?>"></script>


  <?php if (!empty($js)) : ?>
      <?php foreach ($js as $j) : ?>
          <script src="<?= base_url('assets/js/' . $j . '?ver=') . filemtime(FCPATH) ?>"></script>
      <?php endforeach ?>
  <?php endif ?>

  <script>
      $(function() {
          //Initialize Select2 Elements
          $('.select-picker').select2({
              theme: 'bootstrap4'
          })
      });

      const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
      });
  </script>

</body>
</html>
