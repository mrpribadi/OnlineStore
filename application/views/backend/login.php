<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/Ionicons/css/ionicons.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/dist/css/AdminLTE.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo BASE_URL('assets/themes/backend/adminlte/plugins/iCheck/all.css') ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .color-palette {
        height: 35px;
        line-height: 35px;
        text-align: center;
        }

        .color-palette-set {
        margin-bottom: 15px;
        }

        .color-palette span {
        font-size: 12px;
        }

        .color-palette:hover span {
        display: block;
        }

        .color-palette-box h4 {
        position: absolute;
        top: 100%;
        left: 25px;
        margin-top: -40px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        display: block;
        z-index: 7;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Online</b>Store</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div id="msg_error"></div>
                </div>
            </div>
                    

            <form id="form_login" action="#">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="User ID" name="uid" id="uid" autocomplete="off">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="passw" id="passw" autocomplete="off">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-block btn-flat bg-purple" id="btn_login">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo BASE_URL('assets/themes/backend/adminlte/plugins/iCheck/icheck.min.js') ?>"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'iradio_square-purple',
                increaseArea: '20%' /* optional */
            });
        });
    </script>

    <script>
        window.onload = function() {
            document.getElementById("uid").focus();
        };

        $(document).ready(function(){
            $('#btn_login').click(function(e){
                if($.trim($('#uid').val())==''){
                    $('#msg_error').html('<div class="bg-maroon disabled color-palette"><span>Username harus diisi</span></div><br>');
                    $('#uid').focus();
                }else if($.trim($('#passw').val())==''){
                    $('#msg_error').html('<div class="bg-maroon disabled color-palette"><span>Password harus diisi</span></div><br>');
                    $('#passw').focus();
                }else{
                    $('#btn_login').hide();
                    var data = $('#form_login').serialize();
                    $.post('<?php echo base_url()?>auth/login', data, function(result){
                        if(result.status=='success'){
                            window.location.href='<?php echo base_url()?>home';
                        }else{
                            $('#msg_error').html('<div class="bg-maroon disabled color-palette"><span>'+result.msg+'</span></div><br>');            
                            $('#uid').val("");
                            $('#passw').val("");
                            $('#uid').focus();                         
                            $('#btn_login').show();   
                        }
                    },'json');
                }
                return false;
            });
        });
        // function login(){
        //     var url = <?php echo BASE_URL(); ?>;
        //     if ($.trim($('#uid').val()) == '' || $.trim($('#passw').val()) == '') {
        //         $('#msg_error').html('<div class="bg-maroon disabled color-palette"><span>Username / Password harus diisi</span></div><br>');
        //     } else {
        //         $.ajax({
        //             type: "POST",
        //             dataType: 'json'
        //             url: url+'login/auth',
        //             data: $("#form_login").serialize();
        //             success: function(response){
        //                 if (response.status == 'failed') {
        //                     $('#msg_error').html('<div class="bg-maroon disabled color-palette"><span>'+response.msg+'</span></div><br>');
        //                 }
        //             }
        //             error: function(){
        //                 alert('Error, Gagal koneksi ke API');
        //             }
        //         });
        //     }
        // }
    </script>
</body>
</html>
