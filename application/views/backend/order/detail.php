<?php
if ($order->pemesanan_status == '0') {
    $status = '<span class="text-danger"><b>Belum Dibayar</b></span>';
} else {
    $status = '<span class="text-green"><b>Sudah Dibayar</b></span>';
}
?>

<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> Ratna Dewi Klinic
                <small class="pull-right">Tanggal: <?php echo formatTanggal($order->pemesanan_detail_tanggal); ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Dari
            <address>
                <strong><?php echo $order->pelanggan_nama ?></strong><br>
                <?php echo $order->pelanggan_kode_member ?><br>
                Telp: <?php echo $order->pelanggan_telepon ?><br>
                Email: <?php echo $order->pelanggan_email ?>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            Untuk
            <address>
                <strong>Ratna Dewi Klinic</strong><br>
                Email: <?php echo $this->session->userdata('email') ?>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice #<?php echo $order->pemesanan_nomer ?></b><br>
            <br>
            <b>Status :</b> <?php echo $status ?><br>
            <b>Nama Rekening :</b> <?php echo $order->konfirmasi_nama_rekening ?><br>
            <b>Nomor Rekening :</b> (<?php echo $order->konfirmasi_nama_bank ?>) <?php echo $order->konfirmasi_nomor_rekening ?>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pelayanan</th>
                        <th>Kode Pelayanan</th>
                        <th>Deskripsi</th>
                        <th>Tgl. Pemesanan (Jam)</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $order->pelayanan_nama ?></td>
                        <td><?php echo $order->pelayanan_kode ?></td>
                        <td><?php echo substr($order->pelayanan_deskripsi, 0, 100) . "...."; ?></td>
                        <td><?php echo formatTanggal($order->pemesanan_detail_tanggal) ?> (<?php echo $order->pemesanan_detail_jam ?>)</td>
                        <td class="text-right"><?php echo formatUang($order->pemesanan_total) ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <form class="form-horizontal" id="form_order">
        <input type="hidden" id="id" name="id" value="<?php echo $order->pemesanan_id ?>">
    </form>

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <p class="lead">Konfirmasi Pembayaran:</p>

            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                <div class="text-center">
                    <img src="<?php echo base_url() ?>assets/confirm/<?php echo $order->konfirmasi_gambar; ?>" class="img-responsive img-thumbnail" width="30%">
                </div>
            </p>

        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Total Bayar:</th>
                        <td class="text-right"><?php echo formatUang($order->pemesanan_total) ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <br><br>
    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <!-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
            <button class="btn btn-warning" onclick="return back()"><i class="fa fa-arrow-left margin-r-5"></i> Kembali</button>
            <!-- <button type="button" class="btn btn-success pull-right">
                <i class="fa fa-credit-card"></i> Submit Payment
            </button> -->
            <!-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
            </button> -->
            <?php if ($order->konfirmasi_status == '') : ?>
                <button class="btn btn-success pull-right" id="btn-approve">
                    <i class="fa fa-check"></i> Setujui
                </button>
                <button class="btn btn-danger pull-right" id="btn-reject" style="margin-right:20px">
                    <i class="fa fa-times"></i> Batalkan
                </button>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- /.content -->
<div class="clearfix"></div>

<script type="text/javascript">
    function back() {
        window.location.href = '<?= base_url() ?>order';
    }
</script>
<script>
    $(document).ready(function() {

        $("#btn-approve").click(function() {
            var data = $("#form_order").serialize();
            //swal(data);
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
                            url: '<?php echo BASE_URL() ?>order/approve',
                            data: data,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if (data.status == 'success') {
                                    swal("Disetujui!", "Pemesanan berhasil disetujui", "success");
                                    window.location.href = '<?= base_url() ?>order';

                                } else {
                                    swal("Gagal", "Persetujuan gagal", "error");
                                }

                            }
                        });
                    }
                });
        });

        $("#btn-reject").click(function() {
            var data = $("#form_order").serialize();
            //swal(data);
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
                            url: '<?php echo BASE_URL() ?>order/reject',
                            data: data,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if (data.status == 'success') {
                                    swal("Dibatalkan!", "Pemesanan berhasil dibatalkan", "success");
                                    window.location.href = '<?= base_url() ?>order';

                                } else {
                                    swal("Gagal", "Pembatalan gagal", "error");
                                }

                            }
                        });
                    }
                });
        });

    })
</script>