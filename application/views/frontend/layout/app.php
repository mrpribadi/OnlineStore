<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <![endif]-->
    <title>KLINIK KECANTIKAN</title>
    <meta name="keywords" content="keywords" />
    <meta name="description" content="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo BASE_URL(); ?>assets/images/favico.ico" />
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/styles/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/pe-icon-7-stroke/css/helper.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/styles/minimal-menu.css" rel="stylesheet" type="text/css" />
    <!--[if LTE IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/styles/minimal-menu-ie.css" />
        <![endif]-->
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/styles/flat-form.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/styles/fancySelect.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/styles/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/styles/allinone_bannerRotator.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/styles/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/styles/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/styles/easy-responsive-tabs.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/styles/styles.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/jqueryui/jquery-ui.css">
    <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/jqueryui/jquery.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/jqueryui/jquery-ui.js"></script>



    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/prefixfree.min.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/modernizr.js"></script>

    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/sweetalert/docs/assets/sweetalert/sweetalert.min.js') ?>"></script>

    <!--[if lt IE 9]>
        <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/html5shiv.js"></script>
        <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/respond.js"></script>
        <![endif]-->

</head>

<body class="home1">
    <div class="topbar">
        <div class="container">
            <div class="left-topbar">
                <?php if ($this->session->userdata('id') == '') { ?>
                    WELCOME GUEST!
                    <a href="<?php echo base_url('login') ?>">LOG IN</a> OR <a href="<?php echo base_url('register') ?>">REGISTER</a>
                <?php } else { ?>
                    WELCOME <?php echo $this->session->userdata('nama'); ?>!
                <?php } ?>
            </div>
            <!-- /.left-topbar -->
            <?php if ($this->session->userdata('id') != '') { ?>
                <div class="right-topbar">
                    <ul class="list-inline">
                        <li>
                            <div class="btn-group">
                                <button class="dropdown dropdown-toggle" data-toggle="dropdown">
                                    <span>My Account</span>
                                    <i class="pe-7s-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo base_url('home/member') ?>"><i class="fa fa-shopping-cart"></i> Booking History</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('logout') ?>"><i class="fa fa-share"></i> Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php } ?>
            <!-- /.right-topbar -->
        </div>
    </div>
    <!-- /.topbar -->
    <hr class="gray-line" />
    <header>
        <div class="container">
            <!-- <a class="logo" href="index.html">
                    <img src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/images/kdo.png" alt="img" />
                </a> -->
            <!-- /.logo -->
            <!-- <div class="header-social">
                    <ul class="list-social">
                        <li><a href="https://www.facebook.com/belikado.co.id/" class="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/belikado_id" class="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/belikado.co.id/" class="instagram"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#" class="vk"><i class="fa fa-google"></i></a></li>
                    </ul>
                </div> -->
            <!-- /.header-social -->
            <!-- <div class="top-cart">
                    <a href="shopping-cart.html">
                        <i class="pe-7s-cart"></i>
                        <span>2</span>
                    </a>
                </div> -->


            <!-- /.top-cart -->
            <nav class="main-nav">
                <div class="minimal-menu">
                    <ul class="menu">
                        <li class="current-menu-item">
                            <a href="<?php echo BASE_URL(); ?>">HOME</a>
                        </li>

                        <?php foreach ($menu as $row) : ?>
                            <li>
                                <a href="<?php echo BASE_URL('pages') . "/" . $row->product_category_url ?>"><?php echo strtoupper($row->product_category_name); ?></a>
                                <ul class="sub-menu">
                                    <?php
                                    foreach ($submenu as $sb) {
                                        if ($sb->product_category_id == $row->product_category_id) {
                                            echo '<li><a href="' . BASE_URL('detail') . '/' . $sb->product_url . '">' . strtoupper($sb->product_name) . '</a></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>

                        <li class="hidden-xs">
                            <div class="wrap-search">
                                <form action="#" class="search-form">
                                    <input type="text" placeholder="(021) 8884885875" value="(021) 8884885875" readonly />
                                    <button type="submit"><i class="pe-7s-phone"></i></button>
                                </form>
                            </div>
                            <!-- /.search-form -->
                        </li>
                    </ul>
                </div>
                <!-- /.minimal-menu -->
            </nav>
            <!-- /.main-nav -->
        </div>
    </header>

    <?php $this->load->view($content) ?>

    <!-- /.custom-blocks -->

    <!-- /.subscribe -->
    <!-- /.locations -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <h3>MENU LINKS</h3>
                    <ul class="list-link">
                        <?php foreach ($menu as $row) : ?>
                            <li><a href="<?php echo BASE_URL('pages') . "/" . $row->product_category_url ?>"><?php echo strtoupper($row->product_category_name); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="col-md-4 col-sm-6">
                    <h3>ABOUT US</h3>
                    <div class="address">
                        Merupakan salah satu klinik kecantikan di Indonesia yang terdapat di beberapa cabang di Jakarta, Bekasi, dan Yogyakarta. Menggabungkan perawatan kecantikan yang dilakukan oleh dokter dan beauty therapist secara terpadu untuk seluruh tubuh anda. Berupaya memberikan hasil yang prima juga kenyamanan, keamanan, keramahan dan privasi.
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <h3>HELP</h3>
                    <ul class="list-link">
                        <li><a href="how-to-buy.html">HOW TO BOOK</a></li>
                        <!-- <li><a href="<?php echo BASE_URL('pages/confirm') ?>">CONFIRMATION</a></li> -->
                    </ul>
                </div>
            </div>
            <div class="bottom-footer">
                <div class="copyright">
                    ©COPYRIGHT <?php echo date("Y") ?>.
                </div>
                <!-- /.copyright -->
            </div>
        </div>
    </footer>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/jquery-1.11.2.min.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/jquery.easing.1.3.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/fancySelect.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/jquery.fancybox.pack.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/jquery.mousewheel.min.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/allinone_bannerRotator.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/owl.carousel.min.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/jquery.countdown.min.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/jquery.waypoints.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <!-- <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/gmaps.js"></script> -->
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/easyResponsiveTabs.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/libs/jquery.raty-fa.js"></script>
    <script src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/scripts/functions.js"></script>
    <script>
        $(document).ready(function() {

            //Date picker
            $('.date').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy',
                changeMonth: true,
                changeYear: true
            })

        });
    </script>
</body>

</html>