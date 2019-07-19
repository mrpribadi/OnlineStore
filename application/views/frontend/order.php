<div class="main">
    <div class="container">
        <div class="header-page">
            <h1>PENDAFTARAN</h1>
        </div>
        <!-- /.header-page -->
        <div class="main-content">
            <div class="check-out-content">
                <form id="form_booking" action="<?php echo BASE_URL('proses/post'); ?>" method="POST" class="check-out-form">
                    <div class="billing-details">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>DATA PERSONAL </h3>
                                <div class="wrap-different-address">
                                    <input class="input-form" type="text" id="fullname" name="fullname" autocomplete="off" value="<?php echo $this->session->userdata('nama'); ?>" required readonly />
                                    <!-- <div class="row">
                                        <div class="col-md-6 pdr-5">
                                            <select name="gender" id="gender" class="custom-select">
                                                <option value="pria" selected>PRIA</option>
                                                <option value="wanita">WANITA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 pdl-5">
                                            <input class="input-form" type="number" placeholder="PHONE" id="phone" name="phone" autocomplete="off" value="<?php echo $this->session->userdata('telp'); ?>" required readonly />
                                        </div>
                                    </div> -->
                                    <input class="input-form" type="number" placeholder="PHONE" id="phone" name="phone" autocomplete="off" value="<?php echo $this->session->userdata('telp'); ?>" required readonly />
                                    <input class="input-form" type="email" placeholder="EMAIL" id="email" name="email" autocomplete="off" value="<?php echo $this->session->userdata('email'); ?>" required readonly />
                                    <input class="input-form" type="hidden" name="product_id" value="<?php echo $produk_detail->pelayanan_id; ?>" />
                                    <input class="input-form" type="hidden" name="product_harga" value="<?php echo $produk_detail->pelayanan_harga; ?>" />
                                    <input class="input-form" type="hidden" name="product_name" value="<?php echo $produk_detail->pelayanan_nama; ?>" />
                                    <input class="input-form" type="hidden" name="product_image" value="<?php echo $produk_detail->pelayanan_gambar; ?>" />
                                </div>
                            </div>
                            <!-- /.wrap-different-address -->

                            <div class="col-md-12">
                                <h3>INFORMASI PENDAFTARAN </h3>
                                <div class="wrap-different-address">
                                    <div class="row">
                                        <div class="col-md-6 pdr-5">
                                            <input class="input-form date" type="text" placeholder="TANGGAL PELAYANAN" id="date" name="date" autocomplete="off" required />
                                        </div>
                                        <div class="col-md-6 pdl-5">
                                            <select name="time" id="time" class="custom-select">
                                                <?php for ($i = 8; $i < 17; $i++) {
                                                    if ($i < 10) {
                                                        $jam = "0" . $i . ":00";
                                                    } else {
                                                        $jam = $i . ":00";
                                                    }
                                                    echo '<option value="' . $i . '">' . $jam . '</option>';
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <textarea class="textarea-form" name="notes" placeholder="CATATAN"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.billing-details -->
                    <h3>PEMBAYARAN</h3>
                    <div class="table-responsive">
                        <table class="check-out-table table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="product-name">Pelayanan</th>
                                    <th class="no-border"></th>
                                    <th class="product-subtotal">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-name" style="text-align: left" ;>
                                        <?php echo $produk_detail->pelayanan_nama ?>
                                    </td>
                                    <td class="no-border"></td>
                                    <td class="product-subtotal" style="text-align: right" ;>
                                        Rp. <?php echo formatUang($produk_detail->pelayanan_harga) ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="product-name" style="text-align: left" ;>
                                        <span class="highlight">Total Bayar</span>
                                    </td>
                                    <td class="no-border"></td>
                                    <td class="product-subtotal" style="text-align: right" ;>
                                        <span class="highlight">Rp. <?php echo formatUang($produk_detail->pelayanan_harga) ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- /.check-out-table -->
                    </div>
                    <!-- /.table-responsive -->
                    <div class="payment-methods">
                        <!-- <ul class="responsive-accordion responsive-accordion-default">

                            <li class="first-open">
                                <?php foreach ($payment as $row) : ?>
                                    <div class="responsive-accordion-head">
                                        <input type="radio" name="payment" value="<?php echo $row->payment_type_id ?>" />
                                        <?php echo strtoupper($row->payment_type_nama) ?>
                                    </div>
                                <?php endforeach; ?>
                                <div class="responsive-accordion-panel">
                                    Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.
                                </div>
                            </li>

                        </ul> -->
                        <button type="button" id="bt_complete_order" class="place-order-btn" onClick="complete_order()">
                            <i class="fa fa-check"></i> DAFTAR
                        </button>
                        <!-- <input class="place-order-btn" type="submit" value="PLACE ORDER"> -->
                    </div>
                    <!-- /.payment-methods -->
                </form>
                <!-- /.check-out-form -->
            </div>
            <!-- /.check-out-content -->
        </div>
        <!-- /.main-content -->
    </div>
</div>
<!-- /.main -->

<?php
$this->session->set_flashdata('idproduct', $produk_detail->pelayanan_id);
?>

<script type="text/javascript">
    var site = "<?php echo BASE_URL(); ?>";

    function complete_order() {
        var name = $("#fullname").val();
        if ($.trim($('#fullname').val()) == '') {
            swal("Cancelled", "Nama lengkap harus diisi..", "error");
            $('#fullname').focus();
        } else if ($.trim($('#phone').val()) == '') {
            swal("Cancelled", "Telepon harus diisi..", "error");
            $('#phone').focus();
        } else if ($.trim($('#email').val()) == '') {
            swal("Cancelled", "Email harus diisi..", "error");
            $('#email').focus();
        } else if ($.trim($('#date').val()) == '') {
            swal("Cancelled", "Tanggal harus diisi..", "error");
            $('#date').focus();
        } else {
            $('#bt_complete_order').attr('disabled', true);
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: site + 'proses/post',
                data: $('#form_booking').serialize(),
                success: function(respon) {
                    if (respon.status == 'success') {
                        swal("Success", 'Nomor Order Anda : ' + respon.order_no, "success");
                        $("#fullname").val('');
                        $("#phone").val('');
                        $("#email").val('');
                        $("#date").val('');
                        window.location.href = '<?php echo base_url() ?>pages/payment';
                    } else {
                        alert(respon.message);
                    }
                }
            });
        }
    }
</script>