<?php
if ($order->order_status == '0') {
    $status = '<span class="text-danger"><b>Unpaid</b></span>';
} else {
    $status = '<span class="text-green"><b>Paid</b></span>';
}
?>

<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> Ratna Dewi Clinic
                <small class="pull-right">Date: <?php echo formatTanggal($order->order_date); ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong><?php echo $order->customer_nama ?></strong><br>
                <?php echo $order->customer_code ?><br>
                Phone: <?php echo $order->customer_phone ?><br>
                Email: <?php echo $order->customer_email ?>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>Ratna Dewi Clinic</strong><br>
                Email: <?php echo $this->session->userdata('email') ?>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice #<?php echo $order->order_no ?></b><br>
            <br>
            <b>Status :</b> <?php echo $status ?><br>
            <b>Account Name :</b> <?php echo $order->confirmation_bank_from_account_name ?><br>
            <b>Account No :</b> (<?php echo $order->confirmation_bank_from ?>) <?php echo $order->confirmation_bank_from_account_no ?>
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
                        <th>Treatment</th>
                        <th>Serial #</th>
                        <th>Description</th>
                        <th>Booking Date</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $order->product_name ?></td>
                        <td><?php echo $order->product_reff_code ?></td>
                        <td><?php echo substr($order->product_deskripsi, 0, 100) . "...."; ?></td>
                        <td><?php echo formatTanggal($order->order_working_date) ?> (<?php echo $order->order_working_time ?>)</td>
                        <td class="text-right"><?php echo formatUang($order->order_total) ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <form class="form-horizontal" id="form_order">
        <input type="hidden" id="id" name="id" value="<?php echo $order->order_id ?>">
    </form>

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>

            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                <?php echo $order->payment_type_nama ?>
                <div class="text-center">
                    <img src="<?php echo base_url() ?>assets/confirm/<?php echo $order->confirmation_bank_from_image; ?>" class="img-responsive img-thumbnail" width="30%">
                </div>
            </p>

        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Total:</th>
                        <td class="text-right"><?php echo formatUang($order->order_total) ?></td>
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
            <button class="btn btn-warning" onclick="return back()"><i class="fa fa-arrow-left margin-r-5"></i> Back</button>
            <!-- <button type="button" class="btn btn-success pull-right">
                <i class="fa fa-credit-card"></i> Submit Payment
            </button> -->
            <!-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
            </button> -->
            <button class="btn btn-success pull-right" id="btn-approve">
                <i class="fa fa-check"></i> Approve
            </button>
            <button class="btn btn-danger pull-right" id="btn-reject" style="margin-right:20px">
                <i class="fa fa-times"></i> Reject
            </button>
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
                    title: "Are you sure?",
                    text: "Once approve, you will not be able to recover this order!",
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
                                    swal("Approved!", "Your order has been approved.", "success");
                                    window.location.href = '<?= base_url() ?>order';

                                } else {
                                    swal("Cancelled", "Error approve order", "error");
                                }

                            }
                        });
                    } else {
                        swal("Cancelled", "Your order is not approved :)", "error");
                    }
                });
        });

        $("#btn-reject").click(function() {
            var data = $("#form_order").serialize();
            //swal(data);
            swal({
                    title: "Are you sure?",
                    text: "Once rejected, you will not be able to recover this order!",
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
                                    swal("Rejected!", "Your order has been rejected.", "success");
                                    window.location.href = '<?= base_url() ?>order';

                                } else {
                                    swal("Cancelled", "Error reject data", "error");
                                }

                            }
                        });
                    } else {
                        swal("Cancelled", "Your order is not rejected :)", "error");
                    }
                });
        });

    })
</script>