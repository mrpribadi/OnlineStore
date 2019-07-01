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
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $row->admin_id; ?>">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" autocomplete="off" value="<?php echo $row->admin_full_name; ?>">
                        <div id="name_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" value="<?php echo $row->admin_email; ?>">
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
                            <?php
                            if ($row->admin_level == 'admin_super') {
                                echo '<option value="admin_super" selected>Super Admin</option>
                                      <option value="admin_web">Admin Web</option>
                                      <option value="beautician">Beautician</option>
                                      <option value="dokter">Dokter</option>
                                      <option value="kasir">Kasir</option>';
                            } else if ($row->admin_level == 'admin_web') {
                                echo '<option value="admin_super">Super Admin</option>
                                      <option value="admin_web" selected>Admin Web</option>
                                      <option value="beautician">Beautician</option>
                                      <option value="dokter">Dokter</option>
                                      <option value="kasir">Kasir</option>';
                            } else if ($row->admin_level == 'beautician') {
                                echo '<option value="admin_super">Super Admin</option>
                                      <option value="admin_web">Admin Web</option>
                                      <option value="beautician" selected>Beautician</option>
                                      <option value="dokter">Dokter</option>
                                      <option value="kasir">Kasir</option>';
                            } else if ($row->admin_level == 'dokter') {
                                echo '<option value="admin_super">Super Admin</option>
                                      <option value="admin_web">Admin Web</option>
                                      <option value="beautician">Beautician</option>
                                      <option value="dokter" selected>Dokter</option>
                                      <option value="kasir">Kasir</option>';
                            } else {
                                echo '<option value="admin_super">Super Admin</option>
                                      <option value="admin_web">Admin Web</option>
                                      <option value="beautician">Beautician</option>
                                      <option value="dokter">Dokter</option>
                                      <option value="kasir" selected>Kasir</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-4 col-sm-4">
                        <select name="status" id="status" class="form-control">
                            <?php
                            if ($row->admin_status == 'active') {
                                echo '<option value="active" selected>Aktif</option>
                                  <option value="deactive">Tidak Aktif</option>';
                            } else {
                                echo '<option value="active">Aktif</option>
                                  <option value="deactive" selected>Tidak Aktif</option>';
                            }
                            ?>

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
            <button class="btn btn-danger pull-right" id="btn-delete" style="margin-right:20px">
                <i class="fa fa-trash"></i> Delete
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

        $("#btn-delete").click(function() {
            var data = $("#form_user").serialize();
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this admin!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: '<?php echo BASE_URL() ?>user/delete',
                            data: data,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if (data.status == 'success') {
                                    swal("Deleted!", "Your admin has been deleted.", "success");
                                    window.location.href = '<?= base_url() ?>customer';

                                } else {
                                    swal("Cancelled", "Error delete data", "error");
                                }

                            }
                        });
                    } else {
                        swal("Cancelled", "Your admin is safe :)", "error");
                    }
                });

        });


    })
</script>

<script type="text/javascript">
    function back() {
        window.location.href = '<?= base_url() ?>user';
    }
</script>