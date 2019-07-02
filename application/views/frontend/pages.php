<div class="trending-clothing">
    <div class="container">
        <h3>ALL <?php echo strtoupper($this->uri->segment(2)) ?></h3>
        <h5></h5>
        <div class="row">
            <div class="box-product">
                <?php foreach ($product as $row) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-item">
                            <div class="product-thumb">
                                <div class="main-img">
                                    <a href="<?php echo BASE_URL('detail') . '/' . $row->product_url; ?>">
                                        <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/images/<?php echo $row->product_image; ?>" alt="img" />
                                    </a>
                                </div>
                                <div class="overlay-img">
                                    <a href="<?php echo BASE_URL('detail') . '/' . $row->product_url; ?>">
                                        <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/images/<?php echo $row->product_image; ?>" alt="img" />
                                    </a>
                                </div>
                                <a href="<?php echo BASE_URL('detail') . '/' . $row->product_url; ?>" class="details"><i class="pe-7s-search"></i></a>
                            </div>
                            <h4 class="product-name"><a href="<?php echo BASE_URL('detail') . '/' . $row->product_url; ?>"><?php echo $row->product_name; ?></a></h4>
                            <?php if ($row->product_harga_promo == '0') { ?>
                                <p class="product-price">
                                    Rp. <?php echo formatUang($row->product_harga); ?>
                                </p>
                            <?php } else { ?>
                                <p class="product-price">
                                    <ins><span class="amount">Rp. <?php echo formatUang($row->product_harga_promo); ?></span></ins>
                                    <del><span class="amount">Rp. <?php echo formatUang($row->product_harga); ?></span></del>
                                </p>
                            <?php } ?>
                            <div class="group-buttons">
                                <a href="<?php echo BASE_URL() ?>home/order/<?php echo $row->product_url; ?>">
                                    <button type="button" data-toggle="tooltip" data-placement="top" title="Book Now">
                                        <i class="pe-7s-cart"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
<!-- /.trending-clothing -->