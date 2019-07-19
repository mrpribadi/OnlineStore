<div class="main">
    <div class="container">
        <div class="header-page">
            <h1>BUAT AKUN</h1>
        </div>
        <!-- /.header-page -->
        <div class="main-content">
            <div class="check-out-content">
                <form id="form_register" action="<?php echo BASE_URL('proses/post_account'); ?>" method="POST" class="check-out-form">
                    <div class="billing-details">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>INFORMASI PELANGGAN </h3>
                                <div class="wrap-different-address">
                                    <input class="input-form" type="text" id="fullname" placeholder="NAMA LENGKAP" name="fullname" autocomplete="off" required />
                                    <div class="row">
                                        <div class="col-md-6 pdr-5">
                                            <select name="gender" id="gender" class="custom-select">
                                                <option value="Pria" selected>PRIA</option>
                                                <option value="Wanita">WANITA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 pdl-5">
                                            <input class="input-form" type="number" placeholder="TELEPON" id="phone" name="phone" autocomplete="off" required />
                                        </div>
                                    </div>
                                    <input class="input-form" type="email" placeholder="EMAIL" id="email" name="email" autocomplete="off" required />
                                    <input class="input-form" type="password" placeholder="PASSWORD" id="password" name="password" required />

                                </div>

                            </div>

                            <!-- /.wrap-different-address -->

                        </div>
                    </div>
                    <div class="payment-methods">

                        <button type="button" id="bt_complete" class="place-order-btn" onClick="complete_register()">
                            <i class="fa fa-check"></i> REGISTRASI SEKARANG
                        </button>
                        <!-- <input class="place-order-btn" type="submit" value="PLACE ORDER"> -->
                    </div>
                    <!-- /.payment-methods -->

                </form>
                <!-- /.check-out-form -->
            </div>
            <!-- /.check-out-content -->
        </div>
        <!-- /.main-content -->
    </div>
</div>
<!-- /.main -->

<script type="text/javascript">
    var site = "<?php echo BASE_URL(); ?>";

    function complete_register() {
        var name = $("#fullname").val();
        if ($.trim($('#fullname').val()) == '') {
            swal("Cancelled", "Nama lengkap harus diisi..", "error");
            $('#fullname').focus();
        } else if ($.trim($('#phone').val()) == '') {
            swal("Cancelled", "Telepon harus diisi..", "error");
            $('#phone').focus();
        } else if ($.trim($('#email').val()) == '') {
            swal("Cancelled", "Email harus diisi..", "error");
            $('#email').focus();
        } else if ($.trim($('#password').val()) == '') {
            swal("Cancelled", "Password harus diisi..", "error");
            $('#password').focus();
        } else {
            $('#bt_complete').attr('disabled', true);
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: site + 'proses/post_account',
                data: $('#form_register').serialize(),
                success: function(respon) {
                    if (respon.status == 'success') {
                        swal("Berhasil", 'Akun berhasil dibuat', "success");
                        $("#fullname").val('');
                        $("#phone").val('');
                        $("#email").val('');
                        $("#password").val('');
                        window.location.href = '<?php echo base_url() ?>home/profile/';
                    } else {
                        swal("Gagal", respon.message, "error");
                    }
                }
            });
        }
    }
</script>