<?php
//echo "<pre>";
//print_r($_SESSION['cart1']);
//echo "</pre>";
require_once 'helpers/Helper.php';
?>
<div class="ps-content pt-80 pb-80">
    <div class="ps-container">
        <div class="ps-cart-listing">
            <h2>Your Cart</h2>
            <?php if (isset($_SESSION['cart1'])): ?>
                <form action="" method="post">
                    <table class="table ps-cart__table">
                        <thead>
                        <tr>
                            <th>All Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                            $total_cart = 0;
                            foreach ($_SESSION['cart1'] AS $product_id => $cart1):
                                $slug = Helper::getSlug($cart1['name']);
                                $url_detail = "chi-tiet-san-pham/$slug/$product_id";
                        ?>
                            <tr>
                            <td><a class="ps-product__preview" href="<?php echo $url_detail;?>"><img class="mr-15" src="../backend/assets/uploads/<?php echo $cart1['avatar']?>" width="100px" height="100px" alt=""><?php echo $cart1['name']; ?></a></td>
                            <td>£ <?php echo $cart1['price']; ?></td>
                            <td>
                                <input type="number" min="0" name="<?php echo $product_id; ?>"
                                       class=" form-control"
                                       value="<?php echo $cart1['quality']?>">
                            </td>
                            <td>
                                £
                                <?php

                                $total_item = $cart1['price'] * $cart1['quality'];
                                 echo $total_item;
                                $total_cart += $total_item;
                                ?>
                            </td>
                            <td>

                                    <a class="content-product-a"
                                       href="xoa-san-pham/<?php echo $product_id; ?>">
                                        <i class="far fa-times-circle"></i>
                                    </a>




                            </td>
                        </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                    <div class="ps-cart__actions">
                        <div class="ps-cart__promotion">
                            <div class="form-group">
                                <input type="submit" name="submit" value="Cập nhật lại giá" class="ps-btn ps-btn--gray">
                            </div>
                            <div class="form-group">
                                <a href="danh-sach-san-pham" class="ps-btn ps-btn--gray"">Continue Shopping</a>

                            </div>

                        </div>

                        <div class="ps-cart__total">
                            <h3>Total Price: <span> £ <?php
                                    echo $total_cart;
                                    ?></span>
                            </h3>
                            <a class="ps-btn" href="thanh-toan">Process to checkout<i class="ps-icon-next"></i></a>



                        </div>
                    </div>
                </form>

            <?php else: ?>
            <h3>
                Cart is empty</h3>
            <?php endif; ?>
        </div>
    </div>
</div>
