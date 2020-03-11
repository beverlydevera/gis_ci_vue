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
<body class="sidebar-mini layout-navbar-fixed accent-info text-sm sidebar-open">
<!-- class="sidebar-mini layout-navbar-fixed sidebar-collapse" -->
    <div class="wrapper">
        <div id="header_nav">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <?php $this->load->view('layout/header_nav') ?>
        </nav>
        <!-- /.navbar -->
        <?php $this->load->view('layout/profile_modal') ?>
        </div>
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
            <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?=base_url('assets/img/other_avatar.png')?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?=strtoupper(sesdata('fullname'))?></a>
                </div>
            </div> -->

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
        <strong>Copyright &copy; <?=date("Y");?> <a href="http://www.braveheartsinstitute.com">Bravehearts Martial Arts Institute</a>.</strong>
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
    <!-- Ekko Lightbox -->
    <script src="<?=base_url()?>assets/template/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <script src="<?= base_url("assets/template/plugins/sweetalert2/sweetalert2.min.js") ?>"></script>
    <script src="<?= base_url('assets/template/plugins/toastr/toastr.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <!-- DASHBOARD SCRIPTS -->
    <!-- <script v-if="activenav='dashboard'" src="<?=base_url()?>assets/template/plugins/chart.js/Chart.min.js"></script>
    <script v-if="activenav='dashboard'" src="<?=base_url()?>assets/template/dist/js/demo.js"></script>
    <script v-if="activenav='dashboard'" src="<?=base_url()?>assets/template/dist/js/pages/dashboard3.js"></script> -->

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

</html>