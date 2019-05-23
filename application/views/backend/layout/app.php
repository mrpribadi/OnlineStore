<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Mosam for Dealer</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <link rel="stylesheet" href="<?php echo BASE_URL('assets/bower_components/bootstrap/dist/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/bower_components/font-awesome/css/font-awesome.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/bower_components/select2/dist/css/select2.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/bower_components/nestable/nestable.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/plugins/iCheck/all.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/dist/css/AdminLTE.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/dist/css/skins/skin-black.css') ?>">
    


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script src="<?php echo BASE_URL('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/bower_components/nestable/jquery.nestable.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/bower_components/fastclick/lib/fastclick.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/bower_components/select2/dist/js/select2.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/bower_components/sweetalert/docs/assets/sweetalert/sweetalert.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/plugins/iCheck/icheck.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/dist/js/adminlte.js') ?>"></script>
    
    <!-- <script src="<?php echo BASE_URL('assets/dist/js/demo.js') ?>"></script> -->
    <!-- <script>
        $(document).ready(function () {
            // select 2
            $('select').select2();

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            })

            // datatable
            $('.data-table').DataTable();

            // iCheck for checkbox and radio inputs
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            });
        })
    </script> -->
</head>
<body class="hold-transition skin-black sidebar-mini fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <a href="<?php echo BASE_URL('home') ?>" class="logo">
                <span class="logo-mini"> <img src="<?php echo BASE_URL('assets/dist/img/logo_small.png') ?>"> </span>
                <span class="logo-lg"> <img src="<?php echo BASE_URL('assets/dist/img/logo_small.png') ?>"> Mosam Dealer</span>
            </a>

            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?php echo BASE_URL('auth/logout') ?>">
                                <i class="fa fa-power-off" style="margin-right: 5px"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <aside class="main-sidebar">
            <section class="sidebar">
                <!-- <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo BASE_URL('assets/dist/img/avatar.png') ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo @$this->session->userdata['user']['user_full_name'] ?></p>
                        <span><i class="fa fa-users"></i> <?php echo @$this->session->userdata['user']['nama_grup'] ?></span>
                    </div>
                </div>

                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <?php if($this->session->userdata['user']['panitia']): ?>
                        <li class="treeview">
                            <a href="#" class="">
                                <i class="fa fa-gears"></i> <span>Konfigurasi</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class=""><a href="<?php echo BASE_URL('periode') ?>"> <i class="fa fa-calendar"></i> Periode Kuis</a></li>
                                <li class=""><a href="<?php echo BASE_URL('grup_peserta') ?>"> <i class="fa fa-users"></i> Grup Peserta</a></li>
                                <li class=""><a href="<?php echo BASE_URL('soal_pg') ?>"> <i class="fa fa-list"></i> Soal Pilihan Ganda</a></li>
                            </ul>
                        </li>
                        <li class=""><a href="<?php echo BASE_URL('fasei') ?>"> <i class="fa fa-bar-chart"></i> Fase 1</a></li>
                        <li class=""><a href="<?php echo BASE_URL('faseii') ?>"> <i class="fa fa-image"></i> Fase 2</a></li>
                        <li class=""><a href="<?php echo BASE_URL('faseiii') ?>"> <i class="fa fa-file-powerpoint-o"></i> Fase 3</a></li>
                    <?php else: ?>
                        <?php if ($this->session->userdata['user']['fase'] == 1): ?>
                            <li class=""><a href="<?php echo BASE_URL('fasei/pilihan_ganda') ?>"> <i class="fa fa-list-ul"></i> Pilihan Ganda</a></li>
                            <li class="treeview">
                                <a href="#" class="">
                                    <i class="fa fa-puzzle-piece"></i> <span>Puzzle</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class=""><a href="<?php echo BASE_URL('fasei/puzzle1') ?>"> <i class="fa fa-puzzle-piece"></i> Puzzle 1</a></li>
                                </ul>
                            </li>
                            <li class=""><a href="<?php echo BASE_URL('fasei/cari_kata') ?>"> <i class="fa fa-search"></i> Cari Kata</a></li>
                        <?php endif ?>
                    <?php endif; ?>
                </ul> -->

            </section>
        </aside>

        <div class="content-wrapper">
            <?php $this->load->view($content) ?>
        </div>

    </div>
    
</body>
</html>
