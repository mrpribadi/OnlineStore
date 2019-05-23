<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        Kategori <br>
        <small>Tambah Kategori</small>
    </h1>
    <div class="content-header-action">
        
    </div>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><div id="app_error"></div></h3>
        </div>
        
        <form class="form-horizontal" id="form_kategori">
        <div class="box-body">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nama Kategori</label>

                <div class="col-sm-4 col-sm-4">
                    <input type="hidden" class="form-control" name="id" id="id">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kategori" autocomplete="off">
                    <div id="name_error"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="parent" class="col-sm-2 control-label">Parent Kategori</label>

                <div class="col-sm-4 col-sm-4">
                    <select name="parent" id="parent" class="form-control">
                        <option value="">--- Select Parent ---</option>
                        <?php
                        foreach ($parent as $pr) {
                        ?>
                        <option value="<?=$pr->product_category_id?>"><?=$pr->product_category_nama?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="url" class="col-sm-2 control-label">URL</label>

                <div class="col-sm-4 col-sm-4">
                    <input type="text" class="form-control" name="url" id="url" placeholder="URL" autocomplete="off">
                    <div id="url_error"></div>
                </div>
            </div>
        </div>
        </form>
        
        <div class="box-footer">
            <button class="btn btn-default" onclick="return back()">Cancel</button>
            <button class="btn btn-info pull-right" id="btn-save" onclick="return insert_branch()">
                <i class="fa fa-save"></i> Save
            </button>
        </div>
    </div>

</section>

<div class="clearfix"></div>

<script>
    $(document).ready(function () {
        // select 2
        $('select').select2();

        $('#btn-save').click(function(){
            if ($.trim($('#nama').val()) == '') {
                var msg = '<p class="text-red">Nama Kategori Required..!</p>';
                $('#app_error').html(msg);
                $('#name').focus();
            }
            else if ($.trim($('#url').val()) == ''){
                var msg = '<p class="text-red">URL Required..!</p>';
                $('#app_error').html(msg);
                $('#url').focus();
            }
            
            else {
                var data = $("#form_kategori").serialize();
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?=base_url()?>kategori/post',
                    data: data,
                    success: function(respon){
                        if (respon.status == 'success') {
                            window.location.href = '<?=base_url()?>kategori';
                        }
                        else {
                            alert(respon.message);
                        }
                    },
                    error:function(){
                        alert('Check Your internet connection..!')
                    }
                });
            }
        });
    })
</script>

<script type="text/javascript">
    function back(){
        window.location.href = '<?=base_url()?>kategori';
    }
</script>