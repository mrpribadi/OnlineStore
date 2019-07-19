<div class="about-company-banner parallax">
    <div class="wrapper">
        <div class="middle">
            <div>
                <img class="content-img" src="<?php echo BASE_URL() ?>assets/banner/about.png" alt="img" />
                <img class="content-img" src="<?php echo BASE_URL() ?>assets/themes/frontend/zorka/assets/images/about-company-banner-title-2.png" alt="img" />
            </div>
        </div>
    </div>
</div>
<!-- /.about-company-banner -->
<div class="theme-features center-features">
    <div class="container">
        <h3 class="mgb-60">PELAYANAN KAMI</h3>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="feature-item pe-7s-star">
                    <h4>CREAM PROGRAM</h4>
                    <p>Apakah yang dimaksud dengan Cream Program (Program Krim) ? Program perawatan kulit sehari-hari dengan menggunakan berbagai macam bahan aktif dengan tujuan untuk mencapai kesehatan kulit</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-item pe-7s-gift">
                    <h4>CHEMICAL PEELING</h4>
                    <p>Apakah yang dimaksud dengan Chemical Peeling? Pengelupasan kulit sampai kedalaman tertentu dengan cara mengoleskan sejumlah larutan kimia tertentu untuk mengatasi berbagai problem kulit</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-item pe-7s-mail-open-file">
                    <h4>AESTHETIC SURGERY</h4>
                    <p>Apakah yang dimaksud dengan Aesthetic Surgery? Prosedur bedah estetik untuk menyempurnakan penampilan wajah dan bentuk tubuh</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.theme-features -->
<hr class="gray-line" />
<div class="our-office">
    <div class="container-fluid">
        <h3 class="mgb-60">KANTOR KAMI</h3>
        <div class="row">
            <div class="col-md-3 col-sm-6 no-pd">
                <div class="office-item">
                    <div class="office-thumb">
                        <div class="main-img">
                            <a href="#">
                                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/banner/office1.jpg" alt="img" />
                            </a>
                        </div>
                        <div class="overlay-img">
                            <a href="#">
                                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/banner/office1.jpg" alt="img" />
                            </a>
                        </div>
                        <a href="#" class="details"><i class="pe-7s-search"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 no-pd">
                <div class="office-item">
                    <div class="office-thumb">
                        <div class="main-img">
                            <a href="#">
                                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/banner/office2.jpg" alt="img" />
                            </a>
                        </div>
                        <div class="overlay-img">
                            <a href="#">
                                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/banner/office2.jpg" alt="img" />
                            </a>
                        </div>
                        <a href="#" class="details"><i class="pe-7s-search"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 no-pd">
                <div class="office-item">
                    <div class="office-thumb">
                        <div class="main-img">
                            <a href="#">
                                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/banner/office3.jpg" alt="img" />
                            </a>
                        </div>
                        <div class="overlay-img">
                            <a href="#">
                                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/banner/office3.jpg" alt="img" />
                            </a>
                        </div>
                        <a href="#" class="details"><i class="pe-7s-search"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 no-pd">
                <div class="office-item">
                    <div class="office-thumb">
                        <div class="main-img">
                            <a href="#">
                                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/banner/office4.jpg" alt="img" />
                            </a>
                        </div>
                        <div class="overlay-img">
                            <a href="#">
                                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/banner/office4.jpg" alt="img" />
                            </a>
                        </div>
                        <a href="#" class="details"><i class="pe-7s-search"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.our-office -->
<hr class="gray-line" />
<div class="our-team">
    <div class="container">
        <h3 class="mgb-60">TIM KAMI</h3>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="table-responsive">
                    <table class="shop-table table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-name">
                                    <h3>Dokter</h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dokter as $dk) : ?>
                                <tr class="cart_item">
                                    <td class="product-name"><?php echo $dk->admin_full_name; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="table-responsive">
                    <table class="shop-table table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-name">
                                    <h3>Beutician</h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($beauty as $bt) : ?>
                                <tr class="cart_item">
                                    <td class="product-name"><?php echo $bt->admin_full_name; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="table-responsive">
                    <table class="shop-table table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-name">
                                    <h3>Kasir</h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kasir as $ks) : ?>
                                <tr class="cart_item">
                                    <td class="product-name"><?php echo $ks->admin_full_name; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.our-team -->
<!-- 
<div class="brand-logos">
    <div class="container">
        <div id="carousel-3">
            <div>
                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/themes/frontend/zorka/assets/images/bershka.png" alt="img" />
            </div>
            <div>
                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/themes/frontend/zorka/assets/images/pull-bear.png" alt="img" />
            </div>
            <div>
                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/themes/frontend/zorka/assets/images/hm.png" alt="img" />
            </div>
            <div>
                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/themes/frontend/zorka/assets/images/zara.png" alt="img" />
            </div>
            <div>
                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/themes/frontend/zorka/assets/images/mango.png" alt="img" />
            </div>
            <div>
                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/themes/frontend/zorka/assets/images/pull-bear.png" alt="img" />
            </div>
            <div>
                <img class="img-responsive" src="<?php echo BASE_URL() ?>assets/themes/frontend/zorka/assets/images/hm.png" alt="img" />
            </div>
        </div>
    </div>
</div> -->
<!-- /.brand-logos -->