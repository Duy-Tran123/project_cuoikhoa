<?php
require_once 'helpers/Helper.php';
?>
<div class="ps-checkout pt-80 pb-80">
    <div class="ps-container">
        <form class="ps-checkout__form" action="" method="post">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                    <div class="ps-checkout__billing">
                        <h3>Billing Detail</h3>
                        <div class="form-group form-group--inline">
                            <label>Full Name<span>*</span>
                            </label>
                            <input class="form-control" type="text" name="fullname">
                        </div>
                        <div class="form-group form-group--inline">
                            <label> Address<span>*</span>
                            </label>
                            <input class="form-control" type="text" name="address">
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Phone<span>*</span>
                            </label>
                            <input class="form-control" type="text" name="mobile">
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Email Address<span>*</span>
                            </label>
                            <input class="form-control" type="email" name="email">
                        </div>
                        <div class="form-group form-group--inline textarea">
                            <label>Order Notes</label>
                            <textarea class="form-control" name="note" rows="5" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                        <footer>
                            <h3>Payment Method</h3>
                            <div class="form-group cheque">
                                <div class="ps-radio">
                                    <input class="form-control" type="radio" id="rdo01" value="1" name="method">
                                    <label for="rdo01">Cheque Payment</label>
                                    <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                </div>
                            </div>
                            <div class="form-group paypal">
                                <div class="ps-radio ps-radio--inline">
                                    <input class="form-control" id="rdo02" type="radio" name="method" value="0">
                                    <label for="rdo02">Paypal</label>
                                </div>
                                <ul class="ps-payment-method">
                                    <li><a href="#"><img src="images/payment/1.png" alt=""></a></li>
                                    <li><a href="#"><img src="images/payment/2.png" alt=""></a></li>
                                    <li><a href="#"><img src="images/payment/3.png" alt=""></a></li>
                                </ul>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="PLACE ORDER" class="btn btn-primary"></input>
                                    <a href="gio-hang-cua-ban" class="btn btn-secondary">BACK TO CART</a>
                                </div>
                            </div>
                        </footer>
<!--                        <div class="form-group">-->
<!--                            <div class="ps-checkbox">-->
<!--                                <input class="form-control" type="checkbox" id="cb01">-->
<!--                                <label for="cb01">Create an account?</label>-->
<!--                            </div>-->
<!--                        </div>-->


                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                    <h3>YOUR ORDER</h3>
                    <?php
                    //biến lưu tổng giá trị đơn hàng
                    $total = 0;
                    if (isset($_SESSION['cart1'])):
                        ?>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th width="40%">PRODUCT</th>
                                <th width="12%">QUALITY</th>
                                <th>PRICE</th>
                                <th>
                                    INTO MONEY</th>
                            </tr>
                            <?php foreach ($_SESSION['cart1'] AS $product_id => $cart1):
                                $product_link = 'san-pham/' . Helper::getSlug($cart1['name']) . "/$product_id";
                                ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($cart1['avatar'])): ?>
                                            <img class="product-avatar img-responsive"
                                                 src="../backend/assets/uploads/<?php echo $cart1['avatar']; ?>" width="60"/>
                                        <?php endif; ?>
                                        <div class="content-product">
                                            <a href="<?php echo $product_link; ?>" class="content-product-a">
                                                <?php echo $cart1['name']; ?>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                              <span class="product-amount">
                                  <?php echo $cart1['quality']; ?>
                              </span>
                                    </td>
                                    <td>
                              <span class="product-price-payment">
                                 £&nbsp;<?php echo $cart1['price'] ?>
                              </span>
                                    </td>
                                    <td>
                              <span class="product-price-payment">
                                  <?php
                                  $price_total = $cart1['price'] * $cart1['quality'];
                                  $total += $price_total;
                                  ?>
                                  £&nbsp;<?php echo $price_total ?>
                              </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5" class="product-total">
                                    TOTAL:
                                    <span class="product-price">
                                        <strong>£&nbsp;<?php echo $total ?></strong>
                            </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    <div class="ps-shipping">
                        <h3>FREE SHIPPING</h3>
                        <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING.<br> <a href="#"> Singup </a> for free shipping on every order, every time.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
