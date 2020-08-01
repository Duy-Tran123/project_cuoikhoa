<?php
require_once 'helpers/Helper.php';
?>
    <!--form search-->
    <form action="" method="GET">
        <div class="form-group">
            <label for="title">Nhập title</label>
            <input type="text" name="title" value="<?php echo isset($_GET['title']) ? $_GET['title'] : '' ?>" id="title"
                   class="form-control"/>
        </div>
        <div class="form-group">
            <label for="title">Chọn danh mục</label>
            <select name="category_id" class="form-control">
                <?php foreach ($categories as $category):
                    //giữ trạng thái selected của category sau khi chọn dựa vào
//                tham số category_id trên trình duyệt
                    $selected = '';
                    if (isset($_GET['category_id']) && $category['id'] == $_GET['category_id']) {
                        $selected = 'selected';
                    }
                    ?>
                    <option value="<?php echo $category['id'] ?>" <?php echo $selected; ?>>
                        <?php echo $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="hidden" name="controller" value="product"/>
        <input type="hidden" name="action" value="index"/>
        <input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary"/>
        <a href="index.php?controller=product" class="btn btn-default">Xóa filter</a>
    </form>


    <h2>Danh sách sản phẩm</h2>
    <a href="index.php?controller=product&action=create" class="btn btn-success">
        <i class="fa fa-plus"></i> Thêm mới
    </a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Category name</th>
            <th>Title</th>
            <th>Avatar</th>
            <th>Price</th>
            <th>Price_Discount</th>
            <th>Size</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th></th>
        </tr>
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id'] ?></td>
                    <td><?php echo $product['category_name'] ?></td>
                    <td><?php echo $product['title'] ?></td>
                    <td>
                        <?php if (!empty($product['avatar'])): ?>
                            <img height="80" src="assets/uploads/<?php echo $product['avatar'] ?>"/>
                        <?php endif; ?>
                    </td>

                    <td><?php echo number_format($product['price']) ?></td>
                    <td><?php echo number_format($product['price_discount']) ?></td>
                    <td>
                        <?php
                        $status_text = '';
                        if ($product['size'] == 0) {
                            $status_text = '4';
                        }elseif ($product['size'] == 1 ){
                            $status_text = '4.5';
                        }elseif ($product['size'] == 2 ){
                            $status_text = '5';
                        }elseif ($product['size'] == 3 ){
                            $status_text = '5.5';
                        }elseif ($product['size'] == 4 ){
                            $status_text = '6';
                        }elseif ($product['size'] == 5 ){
                            $status_text = '6.5';
                        }elseif ($product['size'] == 6 ){
                            $status_text = '7';
                        }elseif ($product['size'] == 7 ){
                            $status_text = '7.5';
                        }elseif ($product['size'] == 8 ){
                            $status_text = '8';
                        }elseif ($product['size'] == 9 ){
                            $status_text = '8.5';
                        }elseif ($product['size'] == 10 ){
                            $status_text = '9';
                        }elseif ($product['size'] == 11 ) {
                            $status_text = '9.5';
                        }elseif ($product['size'] == 12 ) {
                            $status_text = '10';
                        }
                        echo $status_text;
                        ?>
                    </td>
                    <td><?php echo $product['content'] ?></td>
                    <td><?php echo Helper::getStatusText($product['status']) ?></td>

                    <td><?php echo date('d-m-Y H:i:s', strtotime($product['created_at'])) ?></td>
                    <td><?php echo !empty($product['updated_at']) ? date('d-m-Y H:i:s', strtotime($product['updated_at'])) : '--' ?></td>
                    <td>
                        <?php
                        $url_detail = "index.php?controller=product&action=detail&id=" . $product['id'];
                        $url_update = "index.php?controller=product&action=update&id=" . $product['id'];
                        $url_delete = "index.php?controller=product&action=delete&id=" . $product['id'];
                        ?>
                        <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                        <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                        <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="9">No data found</td>
            </tr>
        <?php endif; ?>
    </table>
<?php echo $pages; ?>