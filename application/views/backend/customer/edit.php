<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        Pelanggan <br>
        <small>Edit Pelanggan</small>
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

        <form class="form-horizontal" id="form_customer">
            <div class="box-body">
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $row->pelanggan_id; ?>">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" autocomplete="off" value="<?php echo $row->pelanggan_nama; ?>">
                        <div id="name_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" value="<?php echo $row->pelanggan_email; ?>" readonly>
                        <div id="email_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">No. Telp</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Nomor Telpon" autocomplete="off" value="<?php echo $row->pelanggan_telepon; ?>">
                        <div id="phone_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="col-sm-2 control-label">Jenis Kelamin</label>

                    <div class="col-sm-4 col-sm-4">
                        <select name="gender" id="gender" class="form-control">
                            <?php
                            if ($row->pelanggan_jenis_kelamin == 'Pria') {
                                echo '<option value="pria" selected>Pria</option>
                                <option value="wanita">Wanita</option>';
                            } else {
                                echo '<option value="pria">Pria</option>
                                <option value="wanita" selected>Wanita</option>';
                            }
                            ?>
                        </select>
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

            </div>
        </form>

        <div class="box-footer">
            <button class="btn btn-default" onclick="return back()">Batal</button>
            <button class="btn btn-info pull-right" id="btn-save">
                <i class="fa fa-save"></i> Simpan
            </button>
            <button class="btn btn-danger pull-right" id="btn-delete" style="margin-right:20px">
                <i class="fa fa-trash"></i> Hapus
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
            } else if ($.trim($('#phone').val()) == '') {
                var msg = '<p class="text-red">Nomor telpon harus diisi..!</p>';
                $('#app_error').html(msg);
                $('#phone').focus();
            } else if ($.trim($('#cpassword').val()) != $.trim($('#password').val())) {
                var msg = '<p class="text-red">Confirm password tidak sama..!</p>';
                $('#app_error').html(msg);
                $('#cpassword').focus();
            } else {
                var data = $("#form_customer").serialize();
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?= base_url() ?>customer/post',
                    data: data,
                    success: function(respon) {
                        if (respon.status == 'success') {
                            window.location.href = '<?= base_url() ?>customer';
                        } else {
                            //alert(respon.message);
                            swal("Cancelled", respon.message, "error");
                        }
                    },
                    error: function() {
                        alert('Cek internet kamu..!');
                    }
                });
            }
        });

        $("#btn-delete").click(function() {
            var data = $("#form_customer").serialize();
            swal({
                    title: "Apakah anda yakin?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: '<?php echo BASE_URL() ?>customer/delete',
                            data: data,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if (data.status == 'success') {
                                    swal("Berhasil!", "Data berhasil dihapus.", "success");
                                    window.location.href = '<?= base_url() ?>customer';

                                } else {
                                    swal("Cancelled", "Gagal hapus data", "error");
                                }

                            }
                        });
                    }
                });

        });


    })
</script>

<script type="text/javascript">
    function back() {
        window.location.href = '<?= base_url() ?>customer';
    }
</script>