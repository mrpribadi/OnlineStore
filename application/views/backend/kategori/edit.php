<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        Menu <br>
        <small>Edit Menu</small>
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
                    <label for="name" class="col-sm-2 control-label">Nama Menu</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $row->product_category_id; ?>">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kategori" autocomplete="off" onkeyup="create_url()" value="<?php echo $row->product_category_name; ?>">
                        <div id="name_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="parent" class="col-sm-2 control-label">Parent Menu</label>

                    <div class="col-sm-4 col-sm-4">
                        <select name="parent" id="parent" class="form-control">
                            <option value="">--- Select Parent ---</option>
                            <?php
                            foreach ($parent as $pr) {
                                if ($row->product_category_parent == $pr->product_category_id) {
                                    echo '<option value="' . $pr->product_category_id . '" selected>' . $pr->product_category_name . '</option>';
                                } else {
                                    echo '<option value="' . $pr->product_category_id . '">' . $pr->product_category_name . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="url" class="col-sm-2 control-label">URL</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="text" class="form-control" name="url" id="url" placeholder="URL" autocomplete="off" value="<?php echo $row->product_category_url; ?>" readonly>
                        <div id="url_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="parent" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-4 col-sm-4">
                        <select name="status" id="status" class="form-control">
                            <?php
                            if ($row->product_category_status == 'active') {
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
            <button class="btn btn-info pull-right" id="btn-save" onclick="return insert_branch()">
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
                var msg = '<p class="text-red">Nama Kategori Required..!</p>';
                $('#app_error').html(msg);
                $('#name').focus();
            } else if ($.trim($('#url').val()) == '') {
                var msg = '<p class="text-red">URL Required..!</p>';
                $('#app_error').html(msg);
                $('#url').focus();
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
                        alert('Check Your internet connection..!')
                    }
                });
            }
        });

        $("#btn-delete").click(function() {
            var data = $("#form_kategori").serialize();
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this menu!",
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
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if (data.status == 'success') {
                                    swal("Deleted!", "Your menu has been deleted.", "success");
                                    window.location.href = '<?= base_url() ?>kategori';

                                } else {
                                    swal("Cancelled", "Error delete data", "error");
                                }

                            }
                        });
                    } else {
                        swal("Cancelled", "Your menu is safe :)", "error");
                    }
                });

        });


    })
</script>

<script type="text/javascript">
    function back() {
        window.location.href = '<?= base_url() ?>kategori';
    }

    function create_url() {
        var name = document.getElementById('nama');
        var url = document.getElementById('url');

        url.value = name.value.replace(/ /g, "-").toLowerCase();
    }
</script>