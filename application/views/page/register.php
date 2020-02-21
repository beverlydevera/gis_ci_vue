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

    <script src="<?= base_url('assets/js/plugins/vue.js') ?>"></script>
    <script type="text/javascript">
        window.App = {
            "baseUrl": "<?= base_url() ?>",
            "removeDOM": "",
        };
    </script>
</head>
<body class="hold-transition register-page">
<div class="register-box" id="register_page" style="width:700px;">
  <div class="register-logo">
    <img src="<?=base_url('assets/img/bravehearts_logo.jpg')?>" width="10%">
    <a href="#"><b>Bravehearts Martial Arts Institute</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">User Registration</p>

      <div class="row mb-3">
          <div class="input-group col-md-4">
            <input type="text" class="form-control" @blur="checkifAccountExist('Account Name')" placeholder="Last Name" v-model="registration_info.lastname">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-user"></span>
                </div>
            </div>
          </div>
          <div class="input-group col-md-4">
            <input type="text" class="form-control" @blur="checkifAccountExist('Account Name')" placeholder="First Name" v-model="registration_info.firstname">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-user"></span>
                </div>
            </div>
          </div>
          <div class="input-group col-md-4">
            <input type="text" class="form-control" @blur="checkifAccountExist('Account Name')" placeholder="Middle Name" v-model="registration_info.middlename">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-user"></span>
                </div>
            </div>
          </div>
      </div>

      <div class="row mb-3">
          <div class="input-group col-md-4">
            <input type="email" class="form-control" @blur="checkifAccountExist('Username')" placeholder="Username" v-model="registration_info.username">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-id-card-alt"></span>
                </div>
            </div>
          </div>
          <div class="input-group col-md-4">
            <input type="email" class="form-control" @blur="checkifAccountExist('Email Address')" placeholder="Email" v-model="registration_info.emailadd">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
          </div>
          <div class="input-group col-md-4">
            <input type="email" class="form-control" placeholder="Contact No." v-model="registration_info.contactno">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-phone"></span>
                </div>
            </div>
          </div>
      </div>

      <div class="row mb-3">
          <div class="input-group col-md-6">
            <input type="password" class="form-control" @blur="checkPasswordSame()" placeholder="Password" v-model="registration_info.password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
          </div>
          <div class="input-group col-md-6">
            <input type="password" class="form-control" @blur="checkPasswordSame()" placeholder="Confirm Password" v-model="registration_info.confirmpass" required>
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
          </div>
      </div>

      <div class="row">
        <div class="col-8">
        <div class="icheck-primary">
            <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
            <label for="agreeTerms">
            I agree to the <a href="#modal">terms and conditions</a>
            </label>
        </div>
        </div>
        <div class="col-4">
        <button type="submit" class="btn btn-primary btn-block" @click="registerNewAccount()">Register</button>
        </div>
      </div>

      <a href="<?=base_url("login")?>" class="text-center">I already have a membership</a>
    </div>
  </div>
</div>

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
