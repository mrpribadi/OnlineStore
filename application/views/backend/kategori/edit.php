<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        Kategori <br>
        <small>Edit Kategori</small>
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

        <form class="form-horizontal" id="form_kategori">
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nama Kategori</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $row->kategori_id; ?>">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kategori" autocomplete="off" value="<?php echo $row->kategori_nama; ?>">
                        <div id="name_error"></div>
                    </div>
                </div>

            </div>
        </form>

        <div class="box-footer">
            <button class="btn btn-default" onclick="return back()">Batal</button>
            <button class="btn btn-info pull-right" id="btn-save" onclick="return insert_branch()">
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
                var msg = '<p class="text-red">Nama Kategori Required..!</p>';
                $('#app_error').html(msg);
                $('#name').focus();
            } else {
                var data = $("#form_kategori").serialize();
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?= base_url() ?>kategori/post',
                    data: data,
                    success: function(respon) {
                        if (respon.status == 'success') {
                            window.location.href = '<?= base_url() ?>kategori';
                        } else {
                            alert(respon.message);
                        }
                    },
                    error: function() {
                        alert('Cek internet kamu...!');
                    }
                });
            }
        });

        $("#btn-delete").click(function() {
            var data = $("#form_kategori").serialize();
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
                            url: '<?php echo BASE_URL() ?>kategori/delete',
                            data: data,
                            error: function() {
                                alert('Gagal');
                            },
                            success: function(data) {
                                if (data.status == 'success') {
                                    swal("Berhasil!", "Kategori berhasil dihapus", "success");
                                    window.location.href = '<?= base_url() ?>kategori';

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
        window.location.href = '<?= base_url() ?>kategori';
    }

    // function create_url() {
    //     var name = document.getElementById('nama');
    //     var url = document.getElementById('url');

    //     url.value = name.value.replace(/ /g, "-").toLowerCase();
    // }
</script>