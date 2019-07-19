<div class="log-reg-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="" class="login-form" method="post">
                    <h3>HALAMAN LOGIN</h3>
                    <?php echo $this->session->flashdata('message'); ?>
                    <label for="email">EMAIL*</label>
                    <input class="input-form" type="text" id="email" autocomplete="off" name="email" value="<?php echo set_value('email'); ?>" />
                    <?php echo  form_error('email', '<small class="text-danger">', '</small>'); ?>
                    <label for="password">PASSWORD*</label>
                    <input class="input-form" type="password" id="password" name="password" />
                    <?php echo  form_error('password', '<small class="text-danger">', '</small>'); ?>
                    <br>
                    <button class="submit-btn" type="submit">MASUK</button>
                    <br><br>
                    <a href="<?php echo base_url('home/register') ?>">TIDAK PUNYA AKUN? <br>SILAHKAN DAFTAR DISINI</a>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /.log-reg-content -->