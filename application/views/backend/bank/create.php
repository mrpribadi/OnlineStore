<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        Bank <br>
        <small>Tambah Data Bank</small>
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

        <form class="form-horizontal" id="form_bank">
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nama Bank</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="hidden" class="form-control" name="id" id="id">
                        <input type="text" class="form-control" name="nama_bank" id="nama_bank" placeholder="Nama Bank" autocomplete="off">
                        <div id="nama_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rek" class="col-sm-2 control-label">Nomor Rekening</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="number" class="form-control" name="rek" id="rek" placeholder="1234xxx" autocomplete="off">
                        <div id="rek_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rek" class="col-sm-2 control-label">Nama Pemilik</label>

                    <div class="col-sm-4 col-sm-4">
                        <input type="text" class="form-control" name="pemilik" id="pemilik" placeholder="Nama Pemilik" autocomplete="off">
                        <div id="rek_error"></div>
                    </div>
                </div>
            </div>
        </form>

        <div class="box-footer">
            <button class="btn btn-default" onclick="return back()">Batal</button>
            <button class="btn btn-info pull-right" id="btn-save">
                <i class="fa fa-save"></i> Simpan
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
            if ($.trim($('#nama_bank').val()) == '') {
                var msg = '<p class="text-red">Nama bank harus diisi..!</p>';
                $('#app_error').html(msg);
                $('#nama_bank').focus();
            } else if ($.trim($('#rek').val()) == '') {
                var msg = '<p class="text-red">Nomor rekening harus diisi..!</p>';
                $('#app_error').html(msg);
                $('#rek').focus();
            } else if ($.trim($('#pemilik').val()) == '') {
                var msg = '<p class="text-red">Nama pemilik harus diisi..!</p>';
                $('#app_error').html(msg);
                $('#pemilik').focus();
            } else {
                var data = $("#form_bank").serialize();
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?= base_url() ?>bank/post',
                    data: data,
                    success: function(respon) {
                        if (respon.status == 'success') {
                            window.location.href = '<?= base_url() ?>bank';
                        } else {
                            swal("Cancelled", respon.message, "error");
                        }
                    },
                    error: function() {
                        alert('Cek internet kamu..!')
                    }
                });
            }
        });


    })
</script>

<script type="text/javascript">
    function back() {
        window.location.href = '<?= base_url() ?>bank';
    }

    // function create_url(){
    //     var name = document.getElementById('nama');
    //     var url  = document.getElementById('url');

    //     url.value = name.value.replace(/ /g, "-").toLowerCase();
    // }
</script>