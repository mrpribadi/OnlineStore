<div class="main">
    <div class="container">
        <div class="header-page">
            <h1>PEMESANAN</h1>
        </div>
        <!-- /.header-page -->
        <div class="main-content">
            <div class="table-responsive">
                <table class="shop-table table" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="product-name">Treatment</th>
                            <th class="product-quantity">Tanggal</th>
                            <th class="product-subtotal">Jam </th>
                            <th class="product-price">Harga</th>
                            <th class="product-name">Status</th>
                            <th class="product-name">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($history as $row) : ?>
                            <?php
                            if ($row->pemesanan_status == '0') {
                                $status = '<span class="amount">Belum transfer</span>';
                            } else {
                                $status = 'Lunas';
                            }

                            if ($row->konfirmasi_status == '') {
                                $confirm = '<a href="' . base_url() . 'home/confirm/' . $row->pemesanan_id . '" class="btn btn-danger">Konfirmasi</a>';
                            } else {
                                $confirm = 'Sudah Konfirmasi';
                            }
                            ?>
                            <tr class="cart_item">
                                <td class="product-name"><?php echo $row->pelayanan_nama; ?></td>
                                <td class="product-quantity"><?php echo formatTanggal($row->pemesanan_detail_tanggal); ?></td>
                                <td class="product-price"><?php echo $row->pemesanan_detail_jam; ?></td>
                                <td class="product-price"><?php echo formatUang($row->pemesanan_total); ?></td>
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