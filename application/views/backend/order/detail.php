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
                <i class="fa fa-globe"></i> My Clinic
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
                <strong><?php echo $this->session->userdata('fullname') ?></strong><br>
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
                        <td><?php echo $order->product_deskripsi ?></td>
                        <td><?php echo formatTanggal($order->order_working_date) ?> (<?php echo $order->order_working_time ?>)</td>
                        <td class="text-right"><?php echo formatUang($order->order_total) ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>

            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                <?php echo $order->payment_type_nama ?>
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