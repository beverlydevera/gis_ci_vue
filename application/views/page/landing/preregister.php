<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Bravehearts Martial Arts Institute</title>

  <link rel="stylesheet" href="<?=base_url()?>assets/landing/vendor/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?=base_url()?>assets/landing/css/font.css"/>
  <link rel="stylesheet" href="<?=base_url()?>assets/landing/css/register.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/landing/css/hover.css">
  <link rel="icon" href="<?=base_url()?>assets/landing/images/icon.png">
  
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

<body>

  <div class="container" id="<?= !empty($vueid) ? $vueid : "" ?>">
    <video autoplay muted loop id="myVideo">
      <source src="<?=base_url()?>assets/landing/video/header.mp4" type="video/mp4">
    </video>
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="row">
          <div class="col-md-5 register-left">
            <img src="<?=base_url()?>assets/landing/images/arrow.png" alt="arrow">
            <h3>Join Us</h3>
            <p>We use bravehearts as a metaphor for courage, greatness, strength and leadership. It is our desire to help build our students to be physically, mentally and spiritually strong not only inside the four corners of the gym and in the
              ring, but in facing all life's challenges. </p>
            <a href="<?=base_url()?>#about"><button type="button" class="btn btn-primary">About Us</button></a>
          </div>
          <div class="col-md-7 register-right">
            <h2><span class="alert alert-success">Register Here</span></h2>
            <div class="register-form">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <span style="color:red;">*</span> <i class="fas fa-user-check"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Last Name"  required v-model="preRegistration_Data.lastname">
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <span style="color:red;">*</span> <i class="fas fa-user-check"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="First Name"  required v-model="preRegistration_Data.firstname">
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <span style="color:white;">*</span> <i class="fas fa-user-check"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Middle Name" v-model="preRegistration_Data.middlename">
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <span style="color:red;">*</span> <i class="fas fa-birthday-cake"></i></span>
                </div>
                <input type="date" class="form-control" placeholder="Birthdate" max="<?=date("Y-m-d")?>"  required v-model="preRegistration_Data.birthdate">
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <span style="color:red;">*</span> <i class="fas fa fa-venus-mars"></i></span>
                </div>
                <select class="form-control" v-model="preRegistration_Data.sex" required>
                  <option value=0 disabled selected>Select Sex</option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>
                </select>
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <span style="color:red;">*</span> <i class="fas fa-home"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Address" v-model="preRegistration_Data.homeaddress" required>
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <span style="color:red;">*</span> <i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" placeholder="Email" v-model="preRegistration_Data.emailaddress" required>
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <span style="color:red;">*</span> <i class="fas fa-mobile"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Contact Number" v-model="preRegistration_Data.contactno" required>
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <span style="color:red;">*</span> <i class="fas fa fa-dumbbell"></i></span>
                </div>
                <select class="form-control" v-model="preRegistration_Data.branch_id" required>
                  <option value=0 disabled selected>Select Branch</option>
                  <template v-for="(list,index) in brancheslist">
                    <option :value="list.branch_id">{{list.branch_name}}</option>
                  </template>
                </select>
              </div>
              <button type="button" class="btn btn-primary" @click="savePreRegistration()">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?=base_url()?>assets/landing/vendor/font-awesome/font-awesome.min.js"></script>
  <script src="<?=base_url()?>assets/landing/vendor/jquery/jquery.min.js"></script>
  <!-- <script src="<?=base_url()?>assets/landing/vendor/popper/popper.min.js"></script></script> --> <!-- commented to remove error -->
  <script src="<?=base_url()?>assets/landing/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/landing/js/baguettebox.min.js"></script>

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?= base_url("assets/template/plugins/jquery/jquery.min.js") ?>"></script>
  <!-- Bootstrap -->
  <script src="<?= base_url("assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/plugins/sweetalert.min.js") ?>"></script>
  <script src="<?= base_url("assets/template/plugins/select2/js/select2.full.min.js") ?>"></script>
  <!-- AdminLTE -->
  <!-- <script src="<?= base_url("assets/template/dist/js/adminlte.js") ?>"></script> -->
  <script src="<?= base_url('assets/js/plugins/axios.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/vue-tables-2.min.js') ?>"></script>
  <!-- Ekko Lightbox -->
  <!-- <script src="<?=base_url()?>assets/template/plugins/ekko-lightbox/ekko-lightbox.min.js"></script> -->
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
      
      $(function () {
          $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox({
              alwaysShowClose: true
          });
          });
      })
  </script>

</body>

</html>
