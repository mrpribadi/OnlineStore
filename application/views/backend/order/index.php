<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        Pemesanan <br>
        <small>Daftar Pemesanan</small>
    </h1>
    <div class="content-header-action">
        <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-upload" data-backdrop="static" data-keyboard="false"> <i class="fa fa-upload fa-sm fa-mr"></i> Import</button> -->
        <a href="<?php echo BASE_URL('order/create'); ?>" class="btn btn-success"><i class="fa fa-plus fa-sm fa-mr"></i> Tambah</a>
    </div>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Data</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered data-table" id="table-order">
                        <thead>
                            <tr>
                                <th>No. Pemesanan</th>
                                <th>Nama Lengkap</th>
                                <th>Telp</th>
                                <th>Treatment</th>
                                <th>Tgl. Booking (Jam)</th>
                                <th>Status Pembayaran</th>
                                <th>Status Booking</th>
                                <th></th>
                                <!-- <th>Jenis Kelamin</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($order as $row) {
                                if ($row->pemesanan_status == '0') {
                                    $status = '<span class="text-danger">Belum disetujui</span>';
                                } else if ($row->pemesanan_status == '1') {
                                    $status = '<span class="text-success">Sudah disetujui</span>';
                                } else {
                                    $status = '<span class="text-warning">Ditolak</span>';
                                }

                                if ($row->konfirmasi_status == '') {
                                    $confirm = '<span class="text-danger">Belum Bayar</span>';
                                } else {
                                    $confirm = '<span class="text-success">Sudah Bayar</span>';
                                }
                                ?>
                                <tr id="<?php echo $row->pemesanan_id; ?>">
                                    <td><?php echo $row->pemesanan_nomer; ?></td>
                                    <td><?php echo $row->pelanggan_nama; ?></td>
                                    <td><?php echo $row->pelanggan_telepon; ?></td>
                                    <td><?php echo $row->pelayanan_nama; ?></td>
                                    <td><?php echo date("d F y", strtotime($row->pemesanan_detail_tanggal)); ?> (<?php echo $row->pemesanan_detail_jam; ?>)</td>
                                    <td><?php echo $confirm; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td width="12%" class="text-center">
                                        <a href="<?php echo BASE_URL() . "order/detail/" . $row->pemesanan_id; ?>" class="btn btn-sm bg-purple" alt="Lihat Order">Detail Pemesanan</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>



<script type="text/javascript">
    $(document).ready(function() {
        var actions = 0;
        var new_row = $("<tr class='search-header'/>");
        $('.data-table thead th').each(function(i) {
            var title = $(this).text();
            var new_th = $('<th style ="' + $(this).attr('style') + '"/>');

            if (title != '') {
                $(new_th).append('<input type="text" class="form-control" style="width:100%" placeholder="' + title + '" data-index="' + i + '"/>');
                $(new_row).append(new_th);
            } else {
                actions = 1;
                $(new_row).append(new_th);
            }
        });
        $('.data-table thead').prepend(new_row);

        var orderable = true;
        if (actions > 0) {
            orderable = false;
        }

        var table = $('.data-table').DataTable({
            paging: true,
            ordering: true,
            seraching: true,
            info: true,
            scrollX: true,
            "order": [
                [actions, "asc"]
            ],
            "columnDefs": [{
                "orderable": orderable,
                "targets": 0
            }]
        });
        $('.dataTables_filter').hide();
        $('.dataTables_scrollHeadInner').css('width', '100%');
        $('.data-table').css('width', '100%');

        $(table.table().container()).on('keyup', 'thead input', function() {
            table
                .column($(this).data('index'))
                .search(this.value)
                .draw();
        });
    });
</script>

<script type="text/javascript">
    $(".reject").click(function() {
        var id = $(this).attr("id");
        swal({
                title: "Are you sure?",
                text: "Once reject, you will not be able to recover this order!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?php BASE_URL() ?>order/reject/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                swal("Rejected!", "Your order has been rejected.", "success");

                            } else {
                                swal("Cancelled", "Error reject order", "error");
                            }

                        }
                    });
                } else {
                    swal("Cancelled", "Your order is safe :)", "error");
                }
            });

    });
</script>

<script type="text/javascript">
    $(".approve").click(function() {
        var id = $(this).attr("id");
        swal({
                title: "Are you sure?",
                text: "Once approve, you will not be able to recover this order!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?php BASE_URL() ?>order/approve/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                swal("Approved!", "Your order has been approved.", "success");

                            } else {
                                swal("Cancelled", "Error approve order", "error");
                            }

                        }
                    });
                } else {
                    swal("Cancelled", "Your order is safe :)", "error");
                }
            });

    });
</script>