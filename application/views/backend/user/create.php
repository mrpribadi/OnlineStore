<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        User <br>
        <small>Tambah User</small>
    </h1>
    <div class="content-header-action">

    </div>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <div id="app_error"></div>
            </h3>
        </div>

        <form class="form-horizontal" id="form_user">
            <div class="box-body">
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="hidden" class="form-control" name="id" id="id">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" autocomplete="off">
                        <div id="name_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off">
                        <div id="email_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
                        <div id="password_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpassword" class="col-sm-2 control-label">Confirm Password</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password" autocomplete="off">
                        <div id="cpassword_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="parent" class="col-sm-2 control-label">Level</label>

                    <div class="col-sm-4 col-sm-4">
                        <select name="level" id="level" class="form-control">
                            <option value="admin_super">Super Admin</option>
                            <option value="admin_web">Admin Web</option>
                            <option value="beautician">Beautician</option>
                            <option value="dokter">Dokter</option>
                            <option value="kasir">Kasir</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-4 col-sm-4">
                        <select name="status" id="status" class="form-control">
                            <option value="active">Aktif</option>
                            <option value="deactive">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <div class="box-footer">
            <button class="btn btn-default" onclick="return back()">Cancel</button>
            <button class="btn btn-info pull-right" id="btn-save">
                <i class="fa fa-save"></i> Save
            </button>
        </div>
    </div>

</section>

<div class="clearfix"></div>

<script>
    $(document).ready(function() {
        // select 2
        $('select').select2();

        $('#btn-save').click(function() {
            if ($.trim($('#nama').val()) == '') {
                var msg = '<p class="text-red">Nama lengkap harus diisi..!</p>';
                $('#app_error').html(msg);
                $('#nama').focus();
            } else if ($.trim($('#email').val()) == '') {
                var msg = '<p class="text-red">Email harus diisi..!</p>';
                $('#app_error').html(msg);
                $('#email').focus();
            } else if ($.trim($('#password').val()) == '') {
                var msg = '<p class="text-red">Password harus diisi..!</p>';
                $('#app_error').html(msg);
                $('#password').focus();
            } else if ($.trim($('#cpassword').val()) != $.trim($('#password').val())) {
                var msg = '<p class="text-red">Confirm password tidak sama..!</p>';
                $('#app_error').html(msg);
                $('#cpassword').focus();
            } else {
                var data = $("#form_user").serialize();
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?= base_url() ?>user/post',
                    data: data,
                    success: function(respon) {
                        if (respon.status == 'success') {
                            window.location.href = '<?= base_url() ?>user';
                        } else {
                            //alert(respon.message);
                            swal("Cancelled", respon.message, "error");
                        }
                    },
                    error: function() {
                        alert('Check Your internet connection..!')
                    }
                });
            }
        });


    })
</script>

<script type="text/javascript">
    function back() {
        window.location.href = '<?= base_url() ?>user';
    }
</script>