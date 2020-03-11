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
</head>

<body>

  <div class="container">
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
                  <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Last Name">
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="First Name">
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Middle Name">
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                </div>
                <input type="date" class="form-control" placeholder="Birthdate">
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa fa-venus-mars"></i></span>
                </div>
                <select class="form-control">
                  <option disabled selected>Select Sex</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-home"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Address">
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Contact Number">
              </div>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa fa-dumbbell"></i></span>
                </div>
                <select class="form-control">
                  <option disabled selected>Select Branch</option>
                  <option>Abanao</option>
                  <option>La Trinidad</option>
                </select>
              </div>
              <button type="button" class="btn btn-primary">Register</button>
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
</body>

</html>
