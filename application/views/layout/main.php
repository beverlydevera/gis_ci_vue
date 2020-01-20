<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= $title ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url("assets/template/plugins/fontawesome-free/css/all.min.css") ?>">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("assets/template/dist/css/adminlte.min.css") ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?=base_url("assets/template/plugins/daterangepicker/daterangepicker.css")?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="<?= base_url('assets/css/fonts.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("assets/template/plugins/select2/css/select2.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/template/plugins/sweetalert2/sweetalert2.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/template/plugins/toastr/toastr.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    
    <script src="<?= base_url('assets/js/plugins/vue.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery-3.4.1.min.js') ?>"></script>
    <script type="text/javascript">
        window.App = {
            "baseUrl": "<?= base_url() ?>",
            "removeDOM": "",
        };
    </script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= $title ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url("assets/template/plugins/fontawesome-free/css/all.min.css") ?>">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("assets/template/dist/css/adminlte.min.css") ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?=base_url("assets/template/plugins/daterangepicker/daterangepicker.css")?>">
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
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="sidebar-mini layout-navbar-fixed accent-info text-sm sidebar-open">
<!-- class="sidebar-mini layout-navbar-fixed sidebar-collapse" -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
                </button>
            </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <img src="<?=base_url('assets/img/other_avatar.png')?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                    <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Call me whenever you can...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>
                <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <img src="<?=base_url('assets/img/other_avatar.png')?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                    <h3 class="dropdown-item-title">
                        John Pierce
                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">I got your message bro</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>
                <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <img src="<?=base_url('assets/img/other_avatar.png')?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                    <h3 class="dropdown-item-title">
                        Nora Silvester
                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">The subject goes here</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>
                <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                <i class="fas fa-th-large"></i>
            </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('users/logout') ?>" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="<?=base_url('assets/img/bravehearts_logo.jpg')?>" alt="Bravehearts Logo" class="brand-image img-circle elevation-3" style="opacity:.8">
            <span class="brand-text font-weight-light">Bravehearts Martial Arts Institute</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=base_url('assets/img/other_avatar.png')?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=strtoupper(sesdata('fullname'))?></a>
            </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <?php $this->load->view('layout/nav') ?>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title ?></h1>
                </div><!-- /.col -->
                <?php if (!empty($breadcrumbs)) : ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <?php
                                $brs = "";
                                foreach ($breadcrumbs as $bk => $bv) {
                                    $class = !empty($bv['class']) ? $bv['class'] : "";
                                    $title = $bv['title'];
                                    $link = !empty($bv['link']) ? $bv['link'] : '#';
                                    $brs .= "<li class = ' breadcrumb-item $class'>";
                                    if (!empty($link)) {
                                        $brs .= $title;
                                    } else {
                                        $brs .= " <a href='$link'>$title</a>";
                                    }
                                    $brs .= " </li>";
                                }
                                echo $brs;
                                ?>
                            <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                            <!-- <li class="breadcrumb-item active">Dashboard v3</li> -->
                        </ol>
                    </div><!-- /.col -->
                <?php endif; ?>
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid" id="<?= !empty($vueid) ? $vueid : "" ?>">
                <?php $this->load->view($vfile) ?>
            </div>
        </section>
        <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
        <strong>Copyright &copy; <?=date("Y");?> <a href="">Bravehearts Martial Arts Institute</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.1
        </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

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

    
    <!-- OPTIONAL SCRIPTS -->
    <script src="<?=base_url()?>assets/template/plugins/chart.js/Chart.min.js"></script>
    <script src="<?=base_url()?>assets/template/dist/js/demo.js"></script>
    <script src="<?=base_url()?>assets/template/dist/js/pages/dashboard3.js"></script>

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

</html>