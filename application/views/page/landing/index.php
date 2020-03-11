<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Bravehearts Martial Arts Institute</title>

  <link rel="stylesheet" href="<?=base_url("assets/landing/vendor/bootstrap/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="<?=base_url("assets/landing/css/font.css") ?>">
  <link rel="stylesheet" href="<?=base_url("assets/landing/css/styles.css") ?>">
  <link rel="stylesheet" href="<?=base_url("assets/landing/css/hover.css") ?>">
  <link rel="icon" href="<?=base_url("assets/landing/images/icon.png")?>">

</head>

<body id="page-top">

  <section id="title">
    <!-- Nav Bar -->
    <nav class="navbar navbar-nav navbar-dark navbar-expand-lg fixed-top" id="mainNav">
      <a class="navbar-brand js-scroll-trigger" href="#title"><img src="<?=base_url()?>assets/landing/images/banner11.png" alt="logo" class="img-fluid" ;></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item hvr-underline-reveal">
            <a class="nav-link" href="#news">News</a>
          </li>
          <li class="nav-item hvr-underline-reveal">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item hvr-underline-reveal">
            <a class="nav-link" href="#programs">Programs</a>
          </li>
          <li class="nav-item hvr-underline-reveal">
            <a class="nav-link" href="<?=base_url()?>bravehearts-gallery">Gallery</a>
          </li>
          <li class="nav-item hvr-underline-reveal">
            <a class="nav-link" href="#footer">Contact</a>
          </li>
        </ul>
      </div>
    </nav>

    <video class="lion-vid" autoplay loop muted>
      <source src="<?=base_url()?>assets/landing/video/header.mp4" type="video/mp4">
    </video>
  </section>
  <!-- newss -->
  <section id="news">

    <div class="row">
      <div class="offset-lg-1"></div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div id="news-carousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#news-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#news-carousel" data-slide-to="1"></li>
            <li data-target="#news-carousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active container-fluid">
              <h2 class="news-text"><a href="">We are excited to announce the 2020 summer taekwondo clinic at Bravehearts Martial Arts Institute. Experience fun, fellowship and friendship in an atmosphere of discipline, character and
                  excellence.
                  See you all.
                  Enrollment is on going!</a></h2>
              <p class="news-date">by Bravehearts Martial Arts Institute | Februay 04, 2020</p>
            </div>
            <div class="carousel-item container-fluid">
              <h2 class="news-text"><a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                  ut aliquip ex ea commodo consequat.</a></h2>
              <p class="news-date">by Bravehearts Martial Arts Institute | Februay 04, 2020</p>
            </div>
            <div class="carousel-item container-fluid">
              <h2 class="news-text"><a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus ab maxime accusamus explicabo. Iusto doloribus, placeat cupiditate vero quaerat? Dolorem corrupti nisi nam, illo ex nesciunt
                  modisequi. Labore, libero. Labore, libero. Labore, libero.</a></h2>
              <p class="news-date">by Bravehearts Martial Arts Institute | Februay 04, 2020</p>
            </div>
          </div>
          <a class="carousel-control-prev" href="#news-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#news-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-sm-12 news-video">
        <div class="card bg-dark text-white mb3">
          <div class="card border-light">
            <div class="card-header card-bg-header-color">
              NEWS & EVENTS
            </div>
            <!-- Hidden carousel, will show upon mobile view START-->
            <div id="events-carousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#events-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#events-carousel" data-slide-to="1"></li>
                <li data-target="#events-carousel" data-slide-to="2"></li>
                <li data-target="#events-carousel" data-slide-to="3"></li>
                <li data-target="#events-carousel" data-slide-to="4"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active container-fluid">
                  <img src="<?=base_url()?>assets/landing/images/img-news11.jpg" class="hvr-push" alt="..." data-toggle="modal" data-target="#exampleModalScrollable">
                </div>
                <div class="carousel-item container-fluid">
                  <img src="<?=base_url()?>assets/landing/images/img-news22.jpg" class="hvr-push" alt="..." data-toggle="modal" data-target="#exampleModalScrollable1">
                </div>
                <div class="carousel-item container-fluid">
                  <img src="<?=base_url()?>assets/landing/images/img-news33.jpg" class="hvr-push" alt="..." data-toggle="modal" data-target="#exampleModalScrollable2">
                </div>
                <div class="carousel-item container-fluid">
                  <img src="<?=base_url()?>assets/landing/images/img-news44.jpg" class="hvr-push" alt="..." data-toggle="modal" data-target="#exampleModalScrollable3">
                </div>
                <div class="carousel-item container-fluid">
                  <img src="<?=base_url()?>assets/landing/images/img-news55.jpg" class="hvr-push" alt="..." data-toggle="modal" data-target="#exampleModalScrollable4">
                </div>
              </div>
              <a class="carousel-control-prev" href="#events-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#events-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <!-- Hidden carousel, will show upon mobile view END -->

            <div class="card-body scrollbar" id="style-15">
              <div class="card-body">
                <div class="card-img">
                  <img src="<?=base_url()?>assets/landing/images/img-news11.jpg" class="hvr-push img-fluid" alt="..." data-toggle="modal" data-target="#exampleModalScrollable">
                </div>
              </div>
              <div class="border-top my-3"></div>
              <div class="card-body">
                <div class="card-img">
                  <img src="<?=base_url()?>assets/landing/images/img-news22.jpg" class="hvr-push img-fluid" alt="..." data-toggle="modal" data-target="#exampleModalScrollable1">
                </div>
              </div>
              <div class="border-top my-3"></div>
              <div class="card-body">
                <div class="card-img">
                  <img src="<?=base_url()?>assets/landing/images/img-news33.jpg" class="hvr-push img-fluid" alt="..." data-toggle="modal" data-target="#exampleModalScrollable2">
                </div>
              </div>
              <div class="border-top my-3"></div>
              <div class="card-body">
                <div class="card-img">
                  <img src="<?=base_url()?>assets/landing/images/img-news44.jpg" class="hvr-push img-fluid" alt="..." data-toggle="modal" data-target="#exampleModalScrollable3">
                </div>
              </div>
              <div class="border-top my-3"></div>
              <div class="card-body">
                <div class="card-img">
                  <img src="<?=base_url()?>assets/landing/images/img-news55.jpg" class="hvr-push img-fluid" alt="..." data-toggle="modal" data-target="#exampleModalScrollable4">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <section id="about">
    <div class="container-fluid">
      <div class="row">
        <div class="hvr-underline-from-center about-box col-lg-4">
          <i class="fa fa-2x fa-check-circle about-icon"></i>
          <h3 class="about-heading">ABOUT US</h3>
          <p>BMI is a total program of character development, fitness, self-defense, sports and fun. It is for everyone regardless of age, gender or current physical ability. Its goal is to create an atmosphere of success and accomplishment making
            sure that every student feels great about themselves as they make their journey towards “Discipline, Character and Excellence!”</p>
        </div>
        <div class="hvr-underline-from-center about-box col-lg-4">
          <i class="fas fa-2x fa-eye about-icon"></i>
          <h3 class="about-heading">VISION</h3>
          <p>We help every member of Bravehearts Martial Arts Institute experience satisfaction and by creating in them their desire to excel making sure that every student feels great about themselves as they quest for their personal best in an
            atmosphere of success and accomplishment through our carefully selected martial arts instructions and values.</p>
        </div>
        <div class="hvr-underline-from-center about-box col-lg-4">
          <i class="fa fa-2x fa-bullseye about-icon"></i>
          <h3 class="about-heading">MISSION</h3>
          <p>We commit to become the leading Martial Arts Institute by providing scientific, structured and top of the line martial arts instructions with core values of “Discipline, Character and Excellence,” in an environment where love,
            camaraderie and friendship emanates.</p>
        </div>
      </div>
    </div>
  </section>


  <section id="about-us">
    <div class="container-fluid">
      <div class="row">
        <div class="hvr-reveal about-box col-lg-4 offset2 col-md-12">
          <i class="fas fa-2x fa-people-carry about-us-icon"></i>
          <h3 class="about-us-heading">CHARACTER DEVELOPMENT</h3>
          <p>Martial arts teach the art of self-perfection and the virtue of human life. It teaches the value of respect to instructors, senior students, classmates and themselves. Along with the physical technique of taekwondo and other martial art
            we offer, the central theme in teaching the art is the cultivation of good character and correct attitude.</p>
        </div>
        <div class="hvr-reveal about-box col-lg-4 col-md-12">
          <i class="fas fa-2x fa-dumbbell about-us-icon"></i>
          <h3 class="about-us-heading">PHYSICAL EXERCISE</h3>
          <p>The techniques of martial arts are designed to develop control of all parts of the body while demonstrating poise, allowing flexibility in all joints of the body and helping to relieve fatigue and stress.</p>
        </div>
        <div class="hvr-reveal about-box col-lg-4 col-md-12">
          <i class="fas fa-2x fa-fist-raised about-us-icon"></i>
          <h3 class="about-us-heading">SELF-DEFENSE</h3>
          <p>Martial Arts involve attacking opponents with bare hands and feet. It has the ability to knock down an opponent in one single blow but the emphasis is on mastering defense techniques which come from the martial arts training of
            respecting peace and justice...”never to attack, but to defend oneself.”</p>
        </div>
        <div class="hvr-reveal about-box offset-lg-2 col-lg-4 col-md-12">
          <i class="fas fa-2x fa-running about-us-icon"></i>
          <h3 class="about-us-heading">SPORTS</h3>
          <p>Taekwondo and other martial arts we offer have already grown tremendously into an Olympic sport due to its increased development. It is ideal for children who do not do well in team sports thus, giving them the ability to flourish in
            this activity while combining physical and mental practices.</p>
        </div>
        <div class="hvr-reveal about-box col-lg-4 col-md-12">
          <i class="fas fa-2x fa-laugh-squint about-us-icon"></i>
          <h3 class="about-us-heading">FUN</h3>
          <p>Not all students come to train for competitions. Many come as part of our family and enjoy the benefits our martial arts has to offer while keeping their body fit and healthy at the same time. Whatever your reasons for joining, you will
            certainly have fun by practicing our martial arts inside and outside the gym.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- programs -->

  <section id="programs">
<div class="container-fluid">
      <div class="program-heading program-logo hvr-float-shadow">
        <p><img class="prog-icon" src="<?=base_url()?>assets/landing/images/programs-logo.png" alt="programs-logo" width="48px" ; height="48px" ;></p>
        <h2 class="section-heading">PROGRAMS</h2>
      </div>
      <div id="programs-carousel-mobile" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#programs-carousel-mobile" data-slide-to="0" class="active"></li>
          <li data-target="#programs-carousel-mobile" data-slide-to="1"></li>
          <li data-target="#programs-carousel-mobile" data-slide-to="2"></li>
          <li data-target="#programs-carousel-mobile" data-slide-to="3"></li>
          <li data-target="#programs-carousel-mobile" data-slide-to="4"></li>
          <li data-target="#programs-carousel-mobile" data-slide-to="5"></li>
          <li data-target="#programs-carousel-mobile" data-slide-to="6"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active container-fluid">
            <img class="hvr-push img-fluid" src="<?=base_url()?>assets/landing/images/mighty-program2.png" alt="">
          </div>
          <div class="carousel-item container-fluid">
            <img class="hvr-push img-fluid" src="<?=base_url()?>assets/landing/images/kids-program2.png" alt="">
          </div>
          <div class="carousel-item container-fluid">
            <img class="hvr-push img-fluid" src="<?=base_url()?>assets/landing/images/teens-program2.png" alt="">
          </div>
          <div class="carousel-item container-fluid">
            <img class="hvr-push img-fluid" src="<?=base_url()?>assets/landing/images/active-program2.png" alt="">
          </div>
          <div class="carousel-item container-fluid">
            <img class="hvr-push img-fluid" src="<?=base_url()?>assets/landing/images/family-program2.png" alt="">
          </div>
          <div class="carousel-item container-fluid">
            <img class="hvr-push img-fluid" src="<?=base_url()?>assets/landing/images/olympic-program2.png" alt="">
          </div>
          <div class="carousel-item container-fluid">
            <img class="hvr-push img-fluid" src="<?=base_url()?>assets/landing/images/master-program2.png" alt="">
          </div>
        </div>
        <a class="carousel-control-prev" href="#programs-carousel-mobile" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#programs-carousel-mobile" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
<div class="container">
      <div class="carouselnew">
          <div class="item a"><img src="<?=base_url()?>assets/landing/images/programs/mighty.png" class="img-fluid" alt=""></div>
          <div class="item b"><img src="<?=base_url()?>assets/landing/images/programs/kids.png" class="img-fluid" alt=""></div>
          <div class="item c"><img src="<?=base_url()?>assets/landing/images/programs/teens.png" class="img-fluid" alt=""></div>
          <div class="item d"><img src="<?=base_url()?>assets/landing/images/programs/active.png" class="img-fluid" alt=""></div>
          <div class="item e"><img src="<?=base_url()?>assets/landing/images/programs/family.png" class="img-fluid" alt=""></div>
          <div class="item f"><img src="<?=base_url()?>assets/landing/images/programs/olympic.png" class="img-fluid" alt=""></div>
          <div class="item g"><img src="<?=base_url()?>assets/landing/images/programs/master.png" class="img-fluid" alt=""></div>
        </div>
      </div>

      <!-- <div id="programs-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#programs-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#programs-carousel" data-slide-to="1"></li>
          <li data-target="#programs-carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active container-fluid">
            <img class="hvr-push img-fluid" src="images/mighty-program2.png" alt="">
            <img class="hvr-push img-fluid" src="images/kids-program2.png" alt="">
            <img class="hvr-push img-fluid" src="images/teens-program2.png" alt="">
          </div>
          <div class="carousel-item container-fluid">
            <img class="hvr-push img-fluid" src="images/active-program2.png" alt="">
            <img class="hvr-push img-fluid" src="images/family-program2.png" alt="">
            <img class="hvr-push img-fluid" src="images/olympic-program2.png" alt="">
          </div>
          <div class="carousel-item container-fluid">
            <img class="hvr-push img-fluid" src="images/master-program2.png" alt="">
          </div>
        </div>
        <a class="carousel-control-prev" href="#programs-carousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#programs-carousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div id="programs-carousel-tablet" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#programs-carousel-tablet" data-slide-to="0" class="active"></li>
          <li data-target="#programs-carousel-tablet" data-slide-to="1"></li>
          <li data-target="#programs-carousel-tablet" data-slide-to="2"></li>
          <li data-target="#programs-carousel-tablet" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active container-fluid">
            <img class="hvr-push img-fluid" src="images/mighty-program2.png" alt="">
            <img class="hvr-push img-fluid" src="images/kids-program2.png" alt="">
          </div>
          <div class="carousel-item container-fluid">
            <img class="hvr-push img-fluid" src="images/teens-program2.png" alt="">
            <img class="hvr-push img-fluid" src="images/active-program2.png" alt="">
          </div>
          <div class="carousel-item container-fluid">
            <img class="hvr-push img-fluid" src="images/family-program2.png" alt="">
            <img class="hvr-push img-fluid" src="images/olympic-program2.png" alt="">
          </div>
          <div class="carousel-item container-fluid">
            <img class="hvr-push img-fluid" src="images/master-program2.png" alt="">
          </div>
        </div>
        <a class="carousel-control-prev" href="#programs-carousel-tablet" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#programs-carousel-tablet" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>-->



  </section>

  <section id="map">
    <script>
      // Initialize and add the map
      function initMap() {
        // The location of Uluru
        var uluru = {
          lat: 16.413836729452786,
          lng: 120.59442253500288,

        };

        var uluru1 = {
          lat: 16.456103,
          lng: 120.575618,

        };

        var uluru2 = {
          lat: 16.396614,
          lng: 120.6547887,

        };

        var uluru3 = {
          lat: 16.4488435,
          lng: 120.5898296,

        };

        // The map, centered at Uluru
        var map = new google.maps.Map(
          document.getElementById('map'), {
            zoom: 12,
            center: uluru
          });
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({
          position: uluru,
          map: map

        });

        var marker = new google.maps.Marker({
          position: uluru1,
          map: map

        });

        var marker = new google.maps.Marker({
          position: uluru2,
          map: map

        });

        var marker = new google.maps.Marker({
          position: uluru3,
          map: map

        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOSkGSD-bwSOeV4f-DfxomYCrKuKHSDis&callback=initMap">
    </script>
  </section>



  <!-- Call to Action -->

  <section id="cta">
    <div class="container-fluid">
      <h1 class="big-heading">Experience fun, fellowship and friendship in an atmosphere of <span class="yellow">discipline</span>, <span class="yellow">character</span> and <span class="yellow">excellence</span>. Join now!</h1>
    <a href="<?=base_url()?>bravehearts-register">  <button class="btn btn-lg btn-outline-light button-download" type="button"><i class="fas fa-user-plus"></i> Register</button></a>
    </div>
  </section>

  <section id="press">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          <img class="press-logo img-fluid" src="<?=base_url()?>assets/landing/images/press1.png" alt="bravehearts-logo">
        </div>
        <div class="col-lg-3 col-sm-6">
          <img class="press-logo img-fluid" src="<?=base_url()?>assets/landing/images/press2.png" alt="phil-taekwondo-logo">
        </div>
        <div class="col-lg-3 col-sm-6">
          <img class="press-logo img-fluid" src="<?=base_url()?>assets/landing/images/press3.png" alt="world-taekwondo-logo">
        </div>
        <div class="col-lg-3 col-sm-6">
          <img class="press-logo img-fluid" src="<?=base_url()?>assets/landing/images/press4.png" alt="milo-logo">
        </div>
      </div>

      <div class="border-top my-3"></div>
      <p class="press-p-display"><strong class="yellow">Roofdeck, Abanao Square Mall</strong>
        <em>Smart 0939 094 0117
          Globe 0926 733 8773</em> |
        <strong class="yellow">Rm. 212, 2nd Floor VC Arcadian Bldg Km 5</strong>
        <em>Smart 0920 529 1056
          Landline: 422-8923</em> |
        <strong class="yellow">Lower Gomok Consumer Cooperative, Ucab Itogon Benguet</strong>
        <em>Smart: 0929 180 2642</em> |
        <strong class="yellow">AE224 Western Buyagan, Poblacion, La Trinidad Benguet</strong>
        <em>Smart: 0949 303 5571</em>
      </p>
      <div class="press-p">
        <p><strong class="yellow">Roofdeck, Abanao Square Mall</strong>
        <p><em>Smart 0939 094 0117
            Globe 0926 733 8773</em> </p>
        <p><strong class="yellow">Rm. 2asdasdasd12, 2nd Floor VC Arcadian Bldg Km 5</strong></p>
        <p><em>Smart 0920 529 1056
            Landline: 422-8923</em></p>
        <p><strong class="yellow">Lower Gomok Consumer Cooperative, Ucab Itogon Benguet</strong></p>
        <p><em>Smart: 0929 180 2642</em></p>
        <p><strong class="yellow">AE224 Western Buyagan, Poblacion, La Trinidad Benguet</strong></p>
        <p><em>Smart: 0949 303 5571</em></p>
      </div>
    </div>
  </section>
  <!-- Footer -->

  <footer id="footer">
    <div class="container-fluid">
      <a href=""><i class="hvr-bounce-in social-icon fab fa-twitter"></i></a>
      <a href=""><i class="hvr-bounce-in social-icon fab fa-facebook"></i></a>
      <a href=""><i class="hvr-bounce-in social-icon fab fa-instagram"></i></a>
      <a href=""><i class="hvr-bounce-in social-icon fas fa-envelope"></i></a>
      <p class="copyright">© Copyright 2020 Bravehearts Martial Arts Institute | Developed by Shiftbox Productions</p>
    </div>
  </footer>



  <!-- Modal -->
  <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="<?=base_url()?>assets/landing/images/img-news11.jpg" alt="image-news" class="img-fluid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModalScrollable1" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="<?=base_url()?>assets/landing/images/img-news22.jpg" alt="image-news" class="img-fluid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModalScrollable2" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="<?=base_url()?>assets/landing/images/img-news33.jpg" alt="image-news" class="img-fluid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModalScrollable3" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="<?=base_url()?>assets/landing/images/img-news44.jpg" alt="image-news" class="img-fluid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModalScrollable4" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="<?=base_url()?>assets/landing/images/img-news55.jpg" alt="image-news" class="img-fluid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

    <!-- commented to remove error -->
  <!-- <script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function() {
      $('#myInput').trigger('focus')
    })
  </script> -->

  <!-- Bootstrap core JavaScript -->

  <script src="<?=base_url()?>assets/landing/vendor/font-awesome/font-awesome.min.js"></script>
  <script src="<?=base_url()?>assets/landing/vendor/jquery/jquery.min.js"></script>
  <!-- <script src="<?=base_url()?>assets/landing/vendor/popper/popper.min.js"></script> --> <!-- commented to remove error -->
  <script src="<?=base_url()?>assets/landing/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/landing/js/baguettebox.min.js"></script>


<!-- Transition effect navbar scroll show/hide background -->
  <script type="text/javascript">
    $(document).ready(function() {
      // Transition effect for navbar
      $(window).scroll(function() {
        // checks if window is scrolled more than 500px, adds/removes solid class
        if ($(this).scrollTop() > 400) {
          $('.navbar').addClass('solid');
        } else {
          $('.navbar').removeClass('solid');
        }
      });
    });
  </script>

<!-- Transition effect navbar scroll show/hide background -->

<script type="text/css">
$("#navbarSupportedContent").on('show.bs.collapse', function() {
  $('btn.navbar-toggler').click(function() {
      $("#navbarSupportedContent").collapse('hide');
  });
});
</script>




<!-- Carousel 3D -->
<script type="text/javascript">
var carouselnew = $(".carouselnew"), currdeg  = 0;

function rotate(e){
currdeg = currdeg - 60
carouselnew.css({
  "-webkit-transform": "rotateY("+currdeg+"deg)",
  "-moz-transform": "rotateY("+currdeg+"deg)",
  "-o-transform": "rotateY("+currdeg+"deg)",
  "transform": "rotateY("+currdeg+"deg)"
});
}

// storing state in window.carouselPause
const startCarousel = (e) => window.carouselPause = setInterval(rotate, 4000);
const stopCarousel = (e) => clearInterval(window.carouselPause);

carouselnew.on({
// pause carousel when mouse is over
'mouseenter': stopCarousel,
// resume when mouse is off
'mouseleave': startCarousel
});

// start the carousel when the page is loaded
startCarousel();
</script>

</body>

</html>
