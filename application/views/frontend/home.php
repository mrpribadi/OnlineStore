<div class="slideshow">
    <div id="slideshow1">
        <ul class="allinone_bannerRotator_list">
            <li data-text-id="#content_ss_1"><img src="assets/themes/frontend/zorka/assets/images/slideshoww1.jpg" alt="img" /></li>
            <li data-text-id="#content_ss_2"><img src="assets/themes/frontend/zorka/assets/images/slideshoww2.jpg" alt="img" /></li>
            <li data-text-id="#content_ss_3"><img src="assets/themes/frontend/zorka/assets/images/slideshoww3.jpg" alt="img" /></li>

        </ul>
        <div id="content_ss_1" class="allinone_bannerRotator_texts">
            <!-- <div class="content-slideshow" data-initial-left="50" data-initial-top="280" data-final-left="0" data-final-top="280" data-duration="0.7" data-fade-start="0" data-delay="0.2">
                <img class="content-img" src="assets/themes/frontend/zorka/assets/images/slide1-content-11.png" alt="img" />
            </div> -->
            <div class="content-slideshow" data-initial-left="50" data-initial-top="320" data-final-left="0" data-final-top="320" data-duration="0.6" data-fade-start="0" data-delay="0.6">
                <img class="content-img" src="assets/banner/banner.png" alt="img" />
            </div>
            <!-- <div class="content-link" data-initial-top="440" data-final-top="440" data-duration="10" data-fade-start="0" data-delay="1">
                <a class="link" href="#">Shop now</a>
            </div> -->
        </div>
        <div id="content_ss_2" class="allinone_bannerRotator_texts">
            <div class="content-slideshow" data-initial-top="0" data-final-top="270" data-duration="5" data-fade-start="0" data-delay="0.2">
                <img class="content-img" src="assets/themes/frontend/zorka/assets/images/slide2-content-21.png" alt="img" />
            </div>
            <div class="content-slideshow" data-initial-top="380" data-final-top="380" data-final-left="16" data-duration="10" data-fade-start="0" data-delay="0.8">
                <img class="content-img" src="assets/themes/frontend/zorka/assets/images/slide2-content-22.png" alt="img" />
            </div>
        </div>
        <div id="content_ss_3" class="allinone_bannerRotator_texts">
            <div class="content-slideshow" data-initial-top="0" data-final-top="270" data-duration="5" data-fade-start="0" data-delay="0.2">
                <img class="content-img" src="assets/themes/frontend/zorka/assets/images/slide3-content-31.png" alt="img" />
            </div>
            <!-- <div class="content-slideshow" data-initial-top="380" data-final-top="380" data-final-left="16" data-duration="10" data-fade-start="0" data-delay="0.8">
                <img class="content-img" src="assets/themes/frontend/zorka/assets/images/slide3-content-32.png" alt="img" />
            </div> -->
        </div>
    </div>
</div>
<!-- /.slideshow -->

<!-- /.custom-boxes -->
<div class="sale-off">
    <div class="container">
        <h3>PELAYANAN POPULER</h3>
        <div id="carousel-2">
            <div class="box-content">
                <div class="showcase">
                    <div class="row">
                        <div class="box-product">
                            <?php foreach ($popular as $row) : ?>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <div class="main-img">
                                                <a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>">
                                                    <img class="img-responsive" src="assets/images/<?php echo $row->pelayanan_gambar; ?>" alt="img" />
                                                </a>
                                            </div>
                                            <div class="overlay-img">
                                                <a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>">
                                                    <img class="img-responsive" src="assets/images/<?php echo $row->pelayanan_gambar; ?>" alt="img" />
                                                </a>
                                            </div>
                                            <a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>" class="details"><i class="pe-7s-search"></i></a>
                                        </div>
                                        <h4 class="product-name"><a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>"><?php echo $row->pelayanan_nama; ?></a></h4>
                                        <p class="product-price">
                                            <ins><span class="amount">Rp. <?php echo formatUang($row->pelayanan_harga); ?></span></ins>
                                        </p>
                                        <div class="group-buttons">
                                            <a href="<?php echo BASE_URL() ?>home/order/<?php echo $row->pelayanan_url; ?>">
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Daftar Sekarang">
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
                <div class="showcase">
                    <div class="row">
                        <div class="box-product">
                            <?php foreach ($popular as $row) : ?>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <div class="main-img">
                                                <a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>">
                                                    <img class="img-responsive" src="assets/images/<?php echo $row->pelayanan_gambar; ?>" alt="img" />
                                                </a>
                                            </div>
                                            <div class="overlay-img">
                                                <a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>">
                                                    <img class="img-responsive" src="assets/images/<?php echo $row->pelayanan_gambar; ?>" alt="img" />
                                                </a>
                                            </div>
                                            <a href="single-product.html" class="details"><i class="pe-7s-search"></i></a>
                                        </div>
                                        <h4 class="product-name"><a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>"><?php echo $row->pelayanan_nama; ?></a></h4>
                                        <p class="product-price">
                                            <ins><span class="amount">Rp. <?php echo formatUang($row->pelayanan_harga); ?></span></ins>
                                        </p>
                                        <div class="group-buttons">
                                            <a href="<?php echo BASE_URL() ?>home/order/<?php echo $row->pelayanan_url; ?>">
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Daftar Sekarang">
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
            <div class="nav">
                <span class="prev"><i class="fa fa-angle-left"></i></span>
                <span class="next"><i class="fa fa-angle-right"></i></span>
            </div>
        </div>
    </div>
</div>

<div class="features">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-12">
                <div class="giveway">
                    <a href="<?php echo BASE_URL('pages/pelayanan') ?>">
                        <div class="text-box">
                            PELAYANAN LAIN
                        </div>
                        <div class="icon-box">
                            <i class="pe-7s-more"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.features -->

<!-- /.sale-off -->
<div class="custom-blocks">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="block-item">
                    <h3>PELAYANAN BARU</h3>
                    <div class="row">
                        <?php foreach ($newin as $row) : ?>
                            <div class="col-md-12 col-sm-6">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="block-thumb">
                                            <div class="main-img">
                                                <a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>">
                                                    <img class="img-responsive" src="assets/images/<?php echo $row->pelayanan_gambar; ?>" alt="img" width="30%" />
                                                </a>
                                            </div>
                                            <div class="overlay-img">
                                                <a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>">
                                                    <img class="img-responsive" src="assets/images/<?php echo $row->pelayanan_gambar; ?>" alt="img" width="30%" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h4><a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>"><?php echo strtoupper($row->pelayanan_nama); ?></a></h4>
                                        <p class="price">Rp. <?php echo formatUang($row->pelayanan_harga); ?></p>

                                        <div class="group-buttons">
                                            <a href="<?php echo BASE_URL() ?>home/order/<?php echo $row->pelayanan_url; ?>">
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Daftar Sekarang">
                                                    <i class="pe-7s-cart"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- /.new-in -->
            </div>
            <div class="col-md-6">
                <div class="block-item">
                    <h3>PELAYANAN PROMO</h3>
                    <div class="row">

                        <?php foreach ($promo as $row) : ?>
                            <div class="col-md-12 col-sm-6">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="block-thumb">
                                            <div class="main-img">
                                                <a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>">
                                                    <img class="img-responsive" src="assets/images/<?php echo $row->pelayanan_gambar; ?>" alt="img" width="30%" />
                                                </a>
                                            </div>
                                            <div class="overlay-img">
                                                <a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>">
                                                    <img class="img-responsive" src="assets/images/<?php echo $row->pelayanan_gambar; ?>" alt="img" width="30%" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h4><a href="<?php echo BASE_URL('detail') . '/' . $row->pelayanan_url; ?>"><?php echo strtoupper($row->pelayanan_nama); ?></a></h4>
                                        <?php if ($row->pelayanan_harga_promo == '0') { ?>
                                            <p class="price">Rp. <?php echo formatUang($row->pelayanan_harga); ?></p>
                                        <?php } else { ?>
                                            <p class="price">Rp. <?php echo formatUang($row->pelayanan_harga_promo); ?></p>
                                            <del>
                                                <p class="price">Rp. <?php echo formatUang($row->pelayanan_harga); ?></p>
                                            </del>

                                        <?php } ?>

                                        <div class="group-buttons">
                                            <a href="<?php echo BASE_URL() ?>home/order/<?php echo $row->pelayanan_url; ?>">
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Daftar Sekarang">
                                                    <i class="pe-7s-cart"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <!-- /.featured -->
            </div>
        </div>
    </div>
</div>