<?php
if ($row->pelayanan_promo == '1') {
    $cek_promo = 'checked';
} else {
    $cek_promo = '';
}

if ($row->pelayanan_baru == '1') {
    $cek_new = 'checked';
} else {
    $cek_new = '';
}

if ($row->pelayanan_populer == '1') {
    $cek_popular = 'checked';
} else {
    $cek_popular = '';
}
?>
<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        Pelayanan & Produk <br>
        <small>Edit Pelayanan / Produk</small>
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

        <form class="form-horizontal" id="form_produk" action="<?php echo BASE_URL('item/post') ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Nama Produk</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $row->pelayanan_id; ?>">
                        <input type="hidden" class="form-control" name="reff_code" id="reff_code" value="<?php echo $row->pelayanan_kode; ?>">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Produk" autocomplete="off" value="<?php echo $row->pelayanan_nama; ?>" onkeyup="create_url()">
                        <div id="name_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="parent" class="col-sm-2 control-label">Kategori</label>

                    <div class="col-sm-4 col-sm-4">
                        <select name="parent" id="parent" class="form-control">
                            <option value="">--- Pilih Kategori ---</option>
                            <?php
                            foreach ($parent as $pr) {
                                if ($row->kategori_id == $pr->kategori_id) {
                                    echo '<option value="' . $pr->kategori_id . '" selected>' . $pr->kategori_nama . '</option>';
                                } else {
                                    echo '<option value="' . $pr->kategori_id . '">' . $pr->kategori_nama . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="deskripsi" class="col-sm-2 control-label">Deskripsi</label>

                    <div class="col-sm-4 col-sm-4">

                        <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi Produk" autocomplete="off"><?php echo $row->pelayanan_deskripsi; ?></textarea>
                        <div id="deskripsi_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="url" class="col-sm-2 control-label">URL</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="text" class="form-control" name="url" id="url" placeholder="URL" autocomplete="off" value="<?php echo $row->pelayanan_url; ?>" readonly>
                        <div id="url_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga" class="col-sm-2 control-label">Harga</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" autocomplete="off" value="<?php echo $row->pelayanan_harga; ?>">
                        <div id="harga_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga_promo" class="col-sm-2 control-label">Harga Promo</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="number" class="form-control" name="harga_promo" id="harga_promo" placeholder="Harga Promo" autocomplete="off" value="<?php echo $row->pelayanan_harga_promo; ?>">
                        <div id="harga_promo_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-4" style="margin-left:200px">

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="promo" name="promo" value="1" <?php echo $cek_promo; ?>>
                                PROMO
                            </label>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="new" name="new" value="1" <?php echo $cek_new; ?>>
                                NEW IN
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="popular" name="popular" value="1" <?php echo $cek_popular; ?>>
                                POPULAR
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="foto" class="col-sm-2 control-label">Foto</label>

                    <div class="col-sm-4 col-sm-4">
                        <input id="foto" type="file" name="foto">
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label"></label>

                    <div class="col-sm-4 col-sm-4 image">
                        <p class="help-block">Pratinjau Gambar : </p>
                        <div class="text-center">
                            <img id="foto_view" src="" style="max-width:400px" class="img-responsive img-thumbnail">
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <img src="<?php echo base_url() ?>assets/images/<?php echo $row->pelayanan_gambar; ?>" class="img-responsive img-thumbnail">
                </div>

            </div>


            <div class="box-footer">
                <button class="btn btn-default" onclick="return back()">Batal</button>
                <button class="btn btn-info pull-right" id="btn-save">
                    <i class="fa fa-save"></i> Simpan
                </button>
                <button class="btn btn-danger pull-right" id="btn-delete" style="margin-right:20px" onclick="return delete_item()">
                    <i class="fa fa-trash"></i> Hapus
                </button>
            </div>
        </form>
    </div>

</section>

<div class="clearfix"></div>

<script>
    $(document).ready(function() {
        // select 2
        $('select').select2();

        // $('#btn-save').click(function(){
        //     if ($.trim($('#nama').val()) == '') {
        //         var msg = '<p class="text-red">Nama Produk harus diisi..!</p>';
        //         $('#app_error').html(msg);
        //         $('#nama').focus();
        //     }
        //     else if ($.trim($('#url').val()) == ''){
        //         var msg = '<p class="text-red">URL harus diisi..!</p>';
        //         $('#app_error').html(msg);
        //         $('#url').focus();
        //     }
        //     else if ($.trim($('#harga').val()) == ''){
        //         var msg = '<p class="text-red">Harga harus diisi..!</p>';
        //         $('#app_error').html(msg);
        //         $('#harga').focus();
        //     }
        //     else if ($.trim($('#deskripsi').val()) == ''){
        //         var msg = '<p class="text-red">Deskripsi harus diisi..!</p>';
        //         $('#app_error').html(msg);
        //         $('#deskripsi').focus();
        //     }
        //     else {
        //         var data = $("#form_produk").serialize();
        //         $.ajax({
        //             type: "POST",
        //             dataType: 'json',
        //             url: '<?= base_url() ?>item/post',
        //             data: data,
        //             success: function(respon){
        //                 if (respon.status == 'success') {
        //                     window.location.href = '<?= base_url() ?>item';
        //                 }
        //                 else {
        //                     alert(respon.message);
        //                 }
        //             },
        //             error:function(){
        //                 alert('Check Your internet connection..!')
        //             }
        //         });
        //     }
        // });


    })
</script>

<script type="text/javascript">
    function back() {
        window.location.href = '<?= base_url() ?>item';
    }

    function create_url() {
        var name = document.getElementById('nama');
        var url = document.getElementById('url');

        url.value = name.value.replace(/ /g, "-").toLowerCase();
    }

    function delete_item() {
        var data = $("#form_produk").serialize();
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
                        url: '<?php echo BASE_URL() ?>item/delete',
                        data: data,
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                swal("Berhasil!", "Data berhasil dihapus", "success");
                                window.location.href = '<?= base_url() ?>item';

                            } else {
                                swal("Gagal", "Gagal hapus data", "error");
                            }

                        }
                    });
                }
            });
    }
</script>

<script>
    $(function() {
        function readURL(input, view) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#' + view).show();
                    $('#' + view).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        var _URL = window.URL || window.webkitURL;

        $("#foto").change(function() {
            var file = document.getElementById('foto');
            var type = file.files[0].name.split('.').pop();
            var size = file.files[0].size;
            var $image = this;

            img = new Image();

            img.src = _URL.createObjectURL(file.files[0]);
            if (type.toLowerCase() != 'jpg' && type.toLowerCase() != 'png' && type.toLowerCase() != 'jpeg') {
                swal('Pastikan file dengan extension .jpg, .jpeg atau .png!', '', 'error');
                $('#foto').val('');
                $('#foto_view').attr('src', '');
            } else {
                img.onload = function() {
                    readURL($image, 'foto_view');
                }
            }
        });
    });
</script>