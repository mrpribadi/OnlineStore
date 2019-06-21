<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        Order <br>
        <small>Order List</small>
    </h1>
    <div class="content-header-action">
        <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-upload" data-backdrop="static" data-keyboard="false"> <i class="fa fa-upload fa-sm fa-mr"></i> Import</button> -->
        <a href="<?php echo BASE_URL('order/create'); ?>" class="btn btn-success"><i class="fa fa-plus fa-sm fa-mr"></i> Tambah</a>
    </div>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered data-table" id="table-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No. Order</th>
                                <th>Nama Lengkap</th>
                                <th>Telp</th>
                                <th>Treatment</th>
                                <th>Tgl. Booking</th>
                                <th>Status Pembayaran</th>
                                <!-- <th>Jenis Kelamin</th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($order as $row) {
                                ?>
                                <tr id="<?php echo $row->order_id; ?>">
                                    <td width="12%">
                                        <a href="<?php echo BASE_URL() . "order/detail/" . $row->order_id; ?>" class="btn btn-sm bg-gray" alt="Lihat Order"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                        <!-- <a href="<?php echo BASE_URL() . "order/approve/" . $row->order_id; ?>" class="btn btn-sm bg-green"><i class="fa fa-check"></i></a>&nbsp;&nbsp; -->
                                        <a href="#" id="<?php echo $row->order_id; ?>" class="btn btn-sm bg-green approve"><i class="fa fa-check"></i></a>&nbsp;&nbsp;
                                        <a href="#" id="<?php echo $row->order_id; ?>" class="btn btn-sm bg-red reject"><i class="fa fa-times"></i></a>
                                    </td>
                                    <td><?php echo $row->order_no; ?></td>
                                    <td><?php echo $row->customer_nama; ?></td>
                                    <td><?php echo $row->customer_phone; ?></td>
                                    <td><?php echo $row->product_name; ?></td>
                                    <td><?php echo date("d F y", strtotime($row->order_working_date)); ?> (<?php echo $row->order_working_time; ?>)</td>
                                    <td><?php echo $row->confirmation_status; ?></td>
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
                                $("#" + id).remove();
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
                                $("#" + id).remove();
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