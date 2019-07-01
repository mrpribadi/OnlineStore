<div class="log-reg-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>CONFIRMATION</h3>
                <form action="" class="register-form" method="post">
                    <label for="bank_name">BANK NAME</label>
                    <input class="input-form" type="text" id="bank_name" name="bank_name" />
                    <?php echo  form_error('bank_name', '<small class="text-danger">', '</small>'); ?>
                    <label for="bank_account_no">BANK ACCOUNT NO</label>
                    <input class="input-form" type="number" id="bank_account_no" name="bank_account_no" />
                    <?php echo  form_error('bank_account_no', '<small class="text-danger">', '</small>'); ?>
                    <label for="bank_account_name">BANK ACCOUNT NAME</label>
                    <input class="input-form" type="text" id="bank_account_name" name="bank_account_name" />
                    <?php echo  form_error('bank_account_name', '<small class="text-danger">', '</small>'); ?>
                    <label for="amount">AMOUNT</label>
                    <input class="input-form" type="number" id="amount" name="amount" />
                    <?php echo  form_error('amount', '<small class="text-danger">', '</small>'); ?>
                    <label for="notes">NOTES</label>
                    <textarea class="input-form" name="notes" id="notes" rows="30"></textarea>
                    <div class="form-group">
                        <label for="foto" class="col-sm-2 control-label">Foto</label>

                        <div class="col-sm-4 col-sm-4">
                            <input id="foto" type="file" name="foto" required>
                        </div>
                    </div>
                    <input type="hidden" name="idorder" id="idorder" value="<?php echo $order->order_id; ?>">

                    <button class="submit-btn" type="submit">CONFIRM</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /.log-reg-content -->