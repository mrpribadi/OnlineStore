<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        Produk <br>
        <small>Tambah Produk</small>
    </h1>
    <div class="content-header-action">
        
    </div>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><div id="app_error"></div></h3>
        </div>
        
        <form class="form-horizontal" id="form_produk" action="<?php echo BASE_URL('item/post') ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label for="nama" class="col-sm-2 control-label">Nama Produk</label>

                <div class="col-sm-4 col-sm-4">
                    <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $row->product_id; ?>">
                    <input type="hidden" class="form-control" name="reff_code" id="reff_code" value="<?php echo $row->product_reff_code; ?>">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Produk" autocomplete="off" value="<?php echo $row->product_name; ?>" onkeyup="create_url()">
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
                            if ($row->product_category_id == $pr->product_category_id){
                                echo '<option value="'.$pr->product_category_id.'" selected>'.$pr->product_category_name.'</option>';
                            }
                            else {
                                echo '<option value="'.$pr->product_category_id.'">'.$pr->product_category_name.'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="deskripsi" class="col-sm-2 control-label">Deskripsi</label>

                <div class="col-sm-4 col-sm-4">
                    
                    <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi Produk" autocomplete="off"><?php echo $row->product_deskripsi; ?></textarea>
                    <div id="deskripsi_error"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="url" class="col-sm-2 control-label">URL</label>

                <div class="col-sm-4 col-sm-4">
                    <input type="text" class="form-control" name="url" id="url" placeholder="URL" autocomplete="off" value="<?php echo $row->product_url; ?>" readonly>
                    <div id="url_error"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="harga" class="col-sm-2 control-label">Harga</label>

                <div class="col-sm-4 col-sm-4">
                    <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" autocomplete="off" value="<?php echo $row->product_harga; ?>">
                    <div id="harga_error"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-2 control-label">Status</label>

                <div class="col-sm-4 col-sm-4">
                    <select name="status" id="status" class="form-control">
                        <?php 
                        if ($row->product_status == 'active') {
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
                    <img id="foto_view" src="" style="max-width:400px">
                </div>
            </div>
        </div>
        
        
        <div class="box-footer">
            <button class="btn btn-default" onclick="return back()">Cancel</button>
            <button class="btn btn-info pull-right" id="btn-save">
                <i class="fa fa-save"></i> Save
            </button>
        </div>
        </form>
    </div>

</section>

<div class="clearfix"></div>

<script>
    $(document).ready(function () {
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
        //             url: '<?=base_url()?>item/post',
        //             data: data,
        //             success: function(respon){
        //                 if (respon.status == 'success') {
        //                     window.location.href = '<?=base_url()?>item';
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
    function back(){
        window.location.href = '<?=base_url()?>item';
    }

    function create_url(){
        var name = document.getElementById('nama');
        var url  = document.getElementById('url');

        url.value = name.value.replace(/ /g, "-").toLowerCase();
    }
</script>

<script>
    $(function () {
        function readURL(input, view) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+view).show();
                    $('#'+view).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        var _URL = window.URL || window.webkitURL;

        $("#foto").change(function(){
            var file = document.getElementById('foto');
            var type = file.files[0].name.split('.').pop();
            var size = file.files[0].size;
            var $image = this;

            img = new Image();

            img.src = _URL.createObjectURL(file.files[0]);
            if(type.toLowerCase() != 'jpg' && type.toLowerCase() != 'png' && type.toLowerCase() != 'jpeg'){
                swal('Pastikan file dengan extension .jpg, .jpeg atau .png!','','error');
                $('#foto').val('');
                $('#foto_view').attr('src','');
            } else {
                img.onload = function() {
                    readURL($image, 'foto_view');
                }
            }
        });
    });
</script>