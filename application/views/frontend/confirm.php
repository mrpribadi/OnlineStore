<div class="log-reg-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>KONFIRMASI PEMBAYARAN</h3>
                <form action="" class="register-form" method="post" enctype="multipart/form-data">
                    <label for="bank_name">NAMA BANK</label>
                    <input class="input-form" type="text" id="bank_name" name="bank_name" />
                    <?php echo  form_error('bank_name', '<small class="text-danger">', '</small>'); ?>
                    <label for="bank_account_no">NOMOR REKENING</label>
                    <input class="input-form" type="number" id="bank_account_no" name="bank_account_no" />
                    <?php echo  form_error('bank_account_no', '<small class="text-danger">', '</small>'); ?>
                    <label for="bank_account_name">NAMA REKENING</label>
                    <input class="input-form" type="text" id="bank_account_name" name="bank_account_name" />
                    <?php echo  form_error('bank_account_name', '<small class="text-danger">', '</small>'); ?>
                    <label for="amount">JUMLAH TRANSFER</label>
                    <input class="input-form" type="number" id="amount" name="amount" />
                    <?php echo  form_error('amount', '<small class="text-danger">', '</small>'); ?>
                    <label for="notes">CATATAN</label>
                    <textarea class="input-form" name="notes" id="notes" rows="30"></textarea>
                    <label for="foto">BUKTI PEMBAYARAN</label>
                    <input id="foto" type="file" name="foto" id="foto">
                    <?php echo  form_error('foto', '<small class="text-danger">', '</small>'); ?>
                    <input type="hidden" name="idorder" id="idorder" value="<?php echo $order->pemesanan_id; ?>">
                    <br><br>
                    <button class="submit-btn" type="submit">KONFIRMASI</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /.log-reg-content -->