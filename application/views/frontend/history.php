<div class="main">
    <div class="container">
        <div class="header-page">
            <h1>HISTORY</h1>
        </div>
        <!-- /.header-page -->
        <div class="main-content">
            <div class="table-responsive">
                <table class="shop-table table" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="product-name">Treatment</th>
                            <th class="product-quantity">Date</th>
                            <th class="product-subtotal">Time</th>
                            <th class="product-price">Price</th>
                            <th class="product-name">Status</th>
                            <th class="product-name">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($history as $row) : ?>
                            <?php
                            if ($row->order_status == '0') {
                                $status = '<span class="amount">Belum transfer</span>';
                            } else {
                                $status = 'Lunas';
                            }

                            if ($row->confirmation_status == '') {
                                $confirm = '<a href="' . base_url() . 'home/confirm/' . $row->order_id . '" class="btn btn-danger">Confirm</a>';
                            } else {
                                $confirm = 'Confirmed';
                            }
                            ?>
                            <tr class="cart_item">
                                <td class="product-name"><?php echo $row->product_name; ?></td>
                                <td class="product-quantity"><?php echo formatTanggal($row->order_working_date); ?></td>
                                <td class="product-price"><?php echo $row->order_working_time; ?></td>
                                <td class="product-price"><?php echo formatUang($row->order_total); ?></td>
                                <td class="product-name"><?php echo $status; ?></td>
                                <td class="product-price"><?php echo $confirm; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- /.shop-table -->
            </div>
        </div>
        <!-- /.main-content -->
    </div>
</div>
<!-- /.main -->