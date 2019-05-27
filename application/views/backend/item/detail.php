<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        Produk <br>
        <small>Detail Produk</small>
    </h1>
    <div class="content-header-action">
        
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-widget">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                    <button class="btn bg-purple" onclick="return back()"><i class="fa fa-arrow-left margin-r-5"></i>Back</button>
                </div>
                
                <div class="box-body">
                    
                    <img src="<?php echo BASE_URL(); ?>assets/images/<?php echo $row->product_image; ?>" alt="<?php echo $row->product_name; ?>" class="img-responsive pad col-lg-4 col-lg-4" style="max-width:400px;">
                    <br>
                    <strong><i class="fa fa-cube margin-r-5"></i> Kode Produk</strong>
                    <p class="text-muted">
                        <?php echo $row->product_reff_code; ?>
                    </p>
                    <hr>

                    <strong><i class="fa fa-cube margin-r-5"></i> Nama Produk</strong>
                    <p class="text-muted">
                        <?php echo $row->product_name; ?>
                    </p>
                    <hr>

                    <strong><i class="fa fa-book margin-r-5"></i> Deskripsi</strong>
                    <p class="text-muted">
                        <?php echo $row->product_deskripsi; ?>
                    </p>
                    <hr>

                    <strong><i class="fa fa-money margin-r-5"></i> Harga</strong>
                    <p class="text-muted">
                        Rp. <?php echo formatUang($row->product_harga); ?>
                    </p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    

</section>

<div class="clearfix"></div>

<script type="text/javascript">
    function back(){
        window.location.href = '<?=base_url()?>item';
    }
</script>
