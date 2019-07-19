<div class="main">
    <div class="container">
        <div class="header-page">
            <h1>INVOICE</h1>
            <?php echo $this->session->flashdata('idproduct'); ?>
        </div>
        <!-- /.header-page -->
        <div class="main-content">
            <form action="#" class="shop-form">
                <div class="table-responsive">
                    <table class="shop-table table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-thumbnail"></th>
                                <th class="product-name">Pelayanan</th>
                                <th class="product-quantity">Tgl. Pemesanan</th>
                                <th class="product-subtotal">Jam</th>
                                <th class="product-price">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="cart_item">
                                <td class="product-thumbnail">
                                    <a href="single-product.html">
                                        <img class="img-responsive" src="<?php echo BASE_URL(); ?>assets/images/<?php echo $this->session->userdata('image'); ?>" alt="img" />
                                    </a>
                                </td>
                                <td class="product-name">
                                    <a href="single-product.html">
                                        <?php echo $this->session->userdata('product_name'); ?>
                                    </a>
                                </td>
                                <td class="product-quantity"><span class="amount"><?php echo formatTanggal($this->session->userdata('tanggal')); ?></span></td>
                                <td class="product-subtotal"><span class="amount"><?php echo $this->session->userdata('waktu'); ?></span></td>
                                <td class="product-price"><span class="amount"><?php echo formatUang($this->session->userdata('harga')); ?></span></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /.shop-table -->
                </div>
                <!-- /.table-responsive -->
                <div class="row mgt-70">
                    <div class="col-md-6">
                        <!-- <h3 class="caption text-center mgb-15"> <img src="<?php echo BASE_URL(); ?>assets/themes/frontend/zorka/assets/images/genicon-card.png" alt="img" /></h3> -->
                        <!-- <h5 class="small-caption text-center mgb-30">Metode Pembayaran Apa Saja Yang Tersedia?</h5> -->
                        <p>Silahkan lakukan pembayaran melalui rekening di bawah ini:
                            <br><br>
                            <?php foreach ($payment as $row) : ?>

                                <h5>No. Rek. <?php echo $row->bank_nomor_rekening . " " . $row->bank_nama . " A/N " . $row->bank_nama_rekening ?></h5>
                            <?php endforeach; ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="shop-totals">
                            <h3>TOTAL</h3>
                            <table class="totals-table">
                                <tr>
                                    <td>Order No:</td>
                                    <td><span class="amount"><?php echo $this->session->userdata('order_no'); ?></span></td>
                                </tr>
                                <tr>
                                    <td>Total:</td>
                                    <td><span class="amount">Rp. <?php echo formatUang($this->session->userdata('harga')); ?></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.main-content -->
    </div>
</div>
<!-- /.main -->