<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Online Store</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/bootstrap/dist/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/font-awesome/css/font-awesome.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/Ionicons/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/select2/dist/css/select2.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/nestable/nestable.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/plugins/iCheck/all.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/dist/css/AdminLTE.css') ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/dist/css/skins/skin-black.css') ?>">
    


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/nestable/jquery.nestable.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/fastclick/lib/fastclick.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/select2/dist/js/select2.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/sweetalert/docs/assets/sweetalert/sweetalert.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/plugins/iCheck/icheck.min.js') ?>"></script>
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/dist/js/adminlte.js') ?>"></script>
    
    <!-- <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/dist/js/demo.js') ?>"></script> -->
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
                <span class="logo-mini"> <img src="<?php echo BASE_URL('assets/themes/backend/adminlte/dist/img/logo_small.png') ?>"> </span>
                <span class="logo-lg"> <img src="<?php echo BASE_URL('assets/themes/backend/adminlte/dist/img/logo_small.png') ?>"> Online Store</span>
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
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo BASE_URL('assets/themes/backend/adminlte/dist/img/avatar.png') ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $this->session->userdata('fullname') ?></p>
                        <span><i class="fa fa-users"></i> <?php echo $this->session->userdata('level') ?></span>
                    </div>
                </div>

                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                        <li class="treeview">
                            <a href="#" class="">
                                <i class="fa fa-cubes"></i> <span>Produk</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class=""><a href="<?php echo BASE_URL('kategori') ?>"> <i class="fa fa-folder"></i> Produk Kategori</a></li>
                                <li class=""><a href="<?php echo BASE_URL('item') ?>"> <i class="fa fa-cube"></i> Produk Item</a></li>
                            </ul>
                        </li>

                        
                        <li class=""><a href="<?php echo BASE_URL('customer') ?>"> <i class="fa fa-users"></i> Customer</a></li>
                        <li class=""><a href="<?php echo BASE_URL('bank') ?>"> <i class="fa fa-credit-card"></i> Bank</a></li>
                        <li class=""><a href="<?php echo BASE_URL('order') ?>"> <i class="fa fa-shopping-cart"></i> Order</a></li>
                        
                    </li>
                </ul>

            </section>
        </aside>

        <div class="content-wrapper">
            <?php $this->load->view($content) ?>
        </div>

    </div>
    
</body>
</html>
