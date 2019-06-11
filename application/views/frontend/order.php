<div class="main">
    <div class="container">
        <div class="header-page">
            <h1>BOOKING</h1>
        </div>
        <!-- /.header-page -->
        <div class="main-content">
            <div class="check-out-content">
                <form id="form-booking" action="<?php echo BASE_URL('proses/post');?>" method="POST" class="check-out-form">
                    <div class="billing-details">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>PERSONAL INFORMATION </h3>
                                <div class="wrap-different-address">
                                    <input class="input-form" type="text" placeholder="FULL NAME" id="fullname" name="fullname" required/>
                                    <div class="row">
                                        <div class="col-md-6 pdr-5">
                                            <select name="gender" id="gender" class="custom-select">
                                                <option value="pria" selected>PRIA</option>
                                                <option value="wanita">WANITA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 pdl-5">
                                            <input class="input-form" type="number" placeholder="PHONE" id="phone" name="phone" required/>
                                        </div>
                                    </div>
                                    <input class="input-form" type="email" placeholder="EMAIL" id="email" name="email" required/>
                                    <input class="input-form" type="hidden" name="product_id" value="<?php echo $produk->product_id; ?>"/>
                                </div>
                            </div>
                            <!-- /.wrap-different-address -->

                            <div class="col-md-12">
                                <h3>BOOKING INFORMATION </h3>
                                <div class="wrap-different-address">
                                    <div class="row">
                                        <div class="col-md-6 pdr-5">
                                            <input class="input-form date" type="text" placeholder="DATE" id="date" name="date" required/>
                                        </div>
                                        <div class="col-md-6 pdl-5">
                                            <select name="time" id="time" class="custom-select">
                                                <?php for ($i=8; $i < 17; $i++) { 
                                                    if ($i < 10){
                                                        $jam = "0".$i.":00";
                                                    }
                                                    else {
                                                        $jam = $i.":00";
                                                    }
                                                    echo '<option value="'.$i.'">'.$jam.'</option>';
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <textarea class="textarea-form" name="notes" placeholder="NOTES"></textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- /.billing-details -->
                    <h3>CHECK OUT</h3>
                    <div class="table-responsive">
                        <table class="check-out-table table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="no-border"></th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-name" style="text-align: left";>
                                        <?php echo $produk->product_name ?>
                                    </td>
                                    <td class="no-border"></td>
                                    <td class="product-subtotal" style="text-align: right";>
                                        Rp. <?php echo formatUang($produk->product_harga) ?>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="product-name" style="text-align: left";>
                                        <span class="highlight">Order Total</span>
                                    </td>
                                    <td class="no-border"></td>
                                    <td class="product-subtotal" style="text-align: right";>
                                        <span class="highlight">Rp. <?php echo formatUang($produk->product_harga) ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- /.check-out-table -->
                    </div>
                    <!-- /.table-responsive -->
                    <div class="payment-methods">
                        <ul class="responsive-accordion responsive-accordion-default">
                
                            <li class="first-open">
                                <?php foreach($payment as $row): ?>
                                <div class="responsive-accordion-head">
                                    <input type="radio" name="payment" value="<?php echo $row->payment_type_id?>"/>
                                    <?php echo strtoupper($row->payment_type_nama)?>
                                </div>
                                <?php endforeach; ?>
                                <div class="responsive-accordion-panel">
                                    Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.
                                </div>
                            </li>
                            
                        </ul>
                        <button class="place-order-btn">PLACE ORDER</button>
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