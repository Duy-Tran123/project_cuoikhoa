<?php
require_once 'helpers/Helper.php';
?>
<div class="ps-products-wrap pt-80 pb-80">
    <div class="ps-products" data-mh="product-listing">
        <input type="hidden" name="controller" value="product"/>
        <input type="hidden" name="action" value="index"/>
        <div class="ps-product__columns">
            <?php if(!empty($products)): ?>
                <?php
                require_once 'helpers/Helper.php';
                foreach ($products AS $product):
                    $product_title = $product['title'];
                    $product_slug = Helper::getSlug($product_title);
                    $product_id = $product['id'];
                    $product_link = "chi-tiet-san-pham/$product_slug/$product_id";
                    ?>

                        <div class="ps-product__column">
                            <div class="ps-shoe mb-30">
                                <div class="ps-shoe__thumbnail">
                                    <div class="ps-badge"><span>New</span></div>

                                    <a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a><img src="../backend/assets/uploads/<?php echo $product['avatar']; ?>" alt=""><a class="ps-shoe__overlay" href="<?php echo $product_link; ?>"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
<!--                                        <div class="ps-shoe__variant normal"><img src="images/shoe/2.jpg" alt=""><img src="images/shoe/3.jpg" alt=""><img src="images/shoe/4.jpg" alt=""><img src="images/shoe/5.jpg" alt=""></div>-->
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#"><?php echo $product['title']; ?></a>
                                        <p class="ps-shoe__categories"><a href="#"><?php echo $product['category_name'] ?></a></p>
                                        <p>
                                            <strong>£&nbsp;<?php echo $product['price'] ?></strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php endforeach; ?>
            <?php else: ?>
                <h2>ko co san pham</h2>
            <?php endif; ?>
        </div>
    </div>
    <div class="ps-sidebar" data-mh="product-listing">
        <form action="" method="POST">
            <aside class="ps-widget--sidebar ps-widget--category">

                <div class="ps-widget__header">
                    <h3>Category</h3>
                </div>

                <div class="ps-widget__content">
                    <?php
                    foreach($categories AS $category):
                        //xứ lý đổ lại dữ liệu ra phần Lọc theo category
                        //để user biết đã tích vào checkbox nào sau khi Filter
                        //dựa vào thuộc tính checked của checkbox/radio
                        //với thẻ select option -> selected
                        $checked = '';
                        //nếu user đã submit form
                        //kiểm tra nếu id của category hiện tại nằm trong mảng
                        //$_POST[category] thì chắc chắn category hiện tại đang
                        //dc checked
                        if (isset($_POST['category'])) {
                            if (in_array($category['id'], $_POST['category'])) {
                                $checked = 'checked';
                            }
                        }
                        ?>
                        <input type="checkbox" name="category[]" <?php echo $checked; ?>
                               value="<?php echo $category['id']; ?>" />
                        <?php echo $category['name']; ?>
                        <br />
                    <?php endforeach; ?>
                    <!--                <ul class="ps-list--checked">-->
                    <!--                    <li class="current"><a href="product-listing.html">Life(521)</a></li>-->
                    <!--                    <li><a href="product-listing.html">Running(76)</a></li>-->
                    <!--                    <li><a href="product-listing.html">Baseball(21)</a></li>-->
                    <!--                    <li><a href="product-listing.html">Football(105)</a></li>-->
                    <!--                    <li><a href="product-listing.html">Soccer(108)</a></li>-->
                    <!--                    <li><a href="product-listing.html">Trainning & game(47)</a></li>-->
                    <!--                    <li><a href="product-listing.html">More</a></li>-->
                    <!--                </ul>-->
                </div>
            </aside>
            <aside class="ps-widget--sidebar ps-widget--filter">
                <div class="ps-widget__header">
                    <h3>Price</h3>
                </div>
                <div class="ps-widget__content">
                    <?php
                    //xử lý đổ lại dữ liệu cho các checkbox liên quan đến
                    //khoảng giá
                    //do đây là dữ liệu tĩnh, nên việc check đổ lại dữ liệu
                    //sẽ theo hướng: có bao nhiêu input checkbox thì sẽ tạo
                    //bấy nhiêu biến checked tương ứng
                    $checked_price1 = '';
                    $checked_price2 = '';
                    $checked_price3 = '';
                    $checked_price4 = '';
                    //nếu user submit form Filter, thì xử lý để đổ lại dữ liệu
                    if (isset($_POST['price'])) {
                        if (in_array(1, $_POST['price'])) {
                            $checked_price1 = 'checked';
                        }
                        if (in_array(2, $_POST['price'])) {
                            $checked_price2 = 'checked';
                        }
                        if (in_array(3, $_POST['price'])) {
                            $checked_price3 = 'checked';
                        }
                        if (in_array(4, $_POST['price'])) {
                            $checked_price4 = 'checked';
                        }
                    }
                    ?>
                    <input type="checkbox" name="price[]"
                           value="1" <?php echo $checked_price1; ?> > Low 100USD <br>
                    <input type="checkbox" name="price[]"
                           value="2" <?php echo $checked_price2; ?>>  100 USD - 200 USD
                    <br>
                    <input type="checkbox" name="price[]"
                           value="3" <?php echo $checked_price3; ?>>  200 USD - 300 USD
                    <br>
                    <input type="checkbox" name="price[]"
                           value="4" <?php echo $checked_price4; ?>> Hight 300 USD
                    <br>
                    <!--                <div class="ac-slider" data-default-min="300" data-default-max="2000" data-max="3450" data-step="50" data-unit="$"></div>-->
                    <!--                <p class="ac-slider__meta">Price:<span class="ac-slider__value ac-slider__min"></span>-<span class="ac-slider__value ac-slider__max"></span></p><a class="ac-slider__filter ps-btn" href="#">Filter</a>-->
                </div>

            </aside>
            <aside class="ps-widget--sidebar ps-widget--category">
                <div class="form-group">
                    <input type="submit" name="filter" value="Filter" class="btn btn-primary">
                    <a href="danh-sach-san-pham" class="btn btn-default">Xóa filter</a>
                </div>
            </aside>
        </form>
    </div>
    <?php echo $pages; ?>
</div>


