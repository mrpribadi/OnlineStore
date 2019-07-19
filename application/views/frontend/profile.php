<div class="main">
    <div class="container">
        <div class="main-content">
            <div class="product">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images">
                            <div id="product-showcase">
                                <div class="gallery">
                                    <div class="overlay-img">
                                        <img class="img-responsive" src="<?php echo BASE_URL(); ?>assets/gif/user.png" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav class="breadcrumb">
                            <a href="<?php echo BASE_URL(); ?>">HOME</a> <i class="fa fa-angle-right"></i> PROFIL</a>
                        </nav>
                        <!-- /.breadcrumb -->
                        <div class="summary">
                            <h2 class="product-name"><?php echo $this->session->userdata('nama'); ?></h2>

                            <br>
                            <ul class="ul-product">
                                <li>Kode Member: <?php echo $this->session->userdata('code'); ?></li>
                                <li>Email: <a href="#"><?php echo $this->session->userdata('email'); ?></a></li>
                                <li>Telepon: <a href="#"><?php echo $this->session->userdata('telp'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.product -->
        </div>
        <!-- /.main-content -->
    </div>
</div>
<!-- /.main -->