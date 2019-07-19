<div class="main">
    <div class="container">
        <div class="main-content">
            <div class="product">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images">
                            <div id="product-showcase">
                                <div class="gallery">
                                    <div class="full">
                                        <img src="<?php echo BASE_URL(); ?>assets/images/<?php echo $product->pelayanan_gambar; ?>" />
                                        <a href="#" class="details"><i class="pe-7s-search"></i></a>
                                    </div>
                                    <!-- <div class="previews">
                                        <div class="box-content">
                                            <div>
                                                <img class="selected" data-full="assets/images/big-productt-3.jpg" src="assets/images/small-productt-3.jpg" />
                                            </div>
                                            <div>
                                                <img data-full="assets/images/big-productt-2.jpg" src="assets/images/small-productt-2.jpg" />
                                            </div>
                                            <div>
                                                <img data-full="assets/images/big-productt-1.jpg" src="assets/images/small-productt-1.jpg" />
                                            </div>
                                            <div>
                                                <img data-full="assets/images/big-productt-3.jpg" src="assets/images/small-productt-3.jpg" />
                                            </div>
                                            <div>
                                                <img data-full="assets/images/big-productt-2.jpg" src="assets/images/small-productt-2.jpg" />
                                            </div>
                                            <div>
                                                <img data-full="assets/images/big-productt-1.jpg" src="assets/images/small-productt-1.jpg" />
                                            </div>
                                            <div>
                                                <img data-full="assets/images/big-productt-3.jpg" src="assets/images/small-productt-3.jpg" />
                                            </div>
                                            <div>
                                                <img data-full="assets/images/big-productt-2.jpg" src="assets/images/small-productt-2.jpg" />
                                            </div>
                                            <div>
                                                <img data-full="assets/images/big-productt-1.jpg" src="assets/images/small-productt-1.jpg" />
                                            </div>
                                        </div>
                                        <div class="nav">
                                            <span class="prev"><i class="fa fa-angle-left"></i></span>
                                            <span class="next"><i class="fa fa-angle-right"></i></span>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav class="breadcrumb">
                            <a href="<?php echo BASE_URL(); ?>">HOME</a> <i class="fa fa-angle-right"></i> <a href="#"><?php echo strtoupper($product->kategori_nama); ?></a>
                        </nav>
                        <!-- /.breadcrumb -->
                        <div class="summary">
                            <h2 class="product-name"><?php echo $product->pelayanan_nama; ?></h2>
                            <div class="product-statistic">
                                <span class="review-count">HARGA</span>
                                <!-- <span class="review-star-read star-rating" data-score="4"></span> -->
                            </div>
                            <div class="price">
                                <?php if ($product->pelayanan_harga_promo == '0') { ?>
                                    Rp. <?php echo formatUang($product->pelayanan_harga); ?>
                                <?php } else { ?>
                                    Rp. <?php echo formatUang($product->pelayanan_harga_promo); ?>
                                    <p>Rp. <del><?php echo formatUang($product->pelayanan_harga); ?></del></p>
                                <?php } ?>

                            </div>
                            <div class="product-action">
                                <div class="clearfix">
                                    <?php if ($product->kategori_id == '1') : ?>
                                        <a href="<?php echo BASE_URL() ?>home/order/<?php echo $product->pelayanan_url; ?>"> <button type="submit" class="add-to-cart-btn"> DAFTAR SEKARANG </button></a>
                                    <?php endif; ?>
                                </div>
                                <!-- <a href="wishlist.html" class="wishlist-link"><i class="pe-7s-like"></i>ADD TO WISHLIST</a> -->
                            </div>
                            <br>
                            <ul class="ul-product">
                                <li>Kode: <?php echo $product->pelayanan_kode; ?></li>
                                <li>Kategori: <a href="#"><?php echo $product->kategori_nama; ?></a></li>
                                <!-- <li>Tags: <a href="parallax-category-shop.html">Shop</a>, <a href="parallax-category-shop.html">Theme</a>, <a href="parallax-category-shop.html">WooCommerce</a>.</li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="product-tabs vertical-tabs">
                    <ul class="resp-tabs-list hor_1">
                        <li>DESKRIPSI</li>
                    </ul>
                    <div class="resp-tabs-container hor_1">
                        <div>
                            <?php echo $product->pelayanan_deskripsi; ?>
                        </div>
                    </div>
                </div>
                <!-- /.product-tabs -->
            </div>
            <!-- /.product -->
        </div>
        <!-- /.main-content -->
    </div>
</div>
<!-- /.main -->