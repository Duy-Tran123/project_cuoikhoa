<h2>Thêm mới sản phẩm</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="category_id">Chọn danh mục</label>
        <select name="category_id" class="form-control" id="category_id">
            <?php foreach ($categories as $category):
                $selected = '';
                if (isset($_POST['category_id']) && $category['id'] == $_POST['category_id']) {
                    $selected = 'selected';
                }
                ?>
                <option value="<?php echo $category['id'] ?>" <?php echo $selected; ?>>
                    <?php echo $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Nhập tên sản phẩm</label>
        <input type="text" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>"
               class="form-control" id="title"/>
    </div>
    <div class="form-group">
        <label for="avatar">Ảnh đại diện</label>
        <input type="file" name="avatar" value="" class="form-control" id="avatar"/>
    </div>
    <div class="form-group">
        <label for="price">Giá</label>
        <input type="number" name="price" value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>"
               class="form-control" id="price"/>
    </div>
    <div class="form-group">
        <label for="price">Giá_Discount</label>
        <input type="number" name="price_discount" value="<?php echo isset($_POST['price_discount']) ? $_POST['price_discount'] : '' ?>"
               class="form-control" id="price"/>
    </div>
    <div class="form-group">
        <label for="status">Size</label>
        <select name="size" class="form-control" id="status">
            <?php
            $selected_0 = '';
            $selected_1 = '';
            $selected_2 = '';
            $selected_3 = '';
            $selected_4 = '';
            $selected_5 = '';
            $selected_6 = '';
            $selected_7 = '';
            $selected_8 = '';
            $selected_9 = '';
            $selected_10 = '';
            $selected_11 = '';
            $selected_12 = '';
            if (isset($_POST['size'])) {
                switch ($_POST['size']) {
                    case 0:
                        $selected_0 = 'selected';
                        break;
                    case 1:
                        $selected_1 = 'selected';
                        break;
                    case 2:
                        $selected_2 = 'selected';
                        break;
                    case 3:
                        $selected_3 = 'selected';
                        break;
                    case 4:
                        $selected_4 = 'selected';
                        break;
                    case 5:
                        $selected_5 = 'selected';
                        break;
                    case 6:
                        $selected_6 = 'selected';
                        break;
                    case 7:
                        $selected_7 = 'selected';
                        break;
                    case 8:
                        $selected_8 = 'selected';
                        break;
                    case 9:
                        $selected_9 = 'selected';
                        break;
                    case 10:
                        $selected_10 = 'selected';
                        break;
                    case 11:
                        $selected_11 = 'selected';
                        break;
                    case 12:
                        $selected_12 = 'selected';
                        break;
                }
            }
            ?>
            <option value="0" <?php echo $selected_0; ?>>4</option>
            <option value="1" <?php echo $selected_1 ?>>4.5</option>
            <option value="2" <?php echo $selected_2 ?>>5</option>
            <option value="3" <?php echo $selected_3 ?>>5.5</option>
            <option value="4" <?php echo $selected_4 ?>>6</option>
            <option value="5" <?php echo $selected_5 ?>>6.5</option>
            <option value="6" <?php echo $selected_6 ?>>7</option>
            <option value="7" <?php echo $selected_7 ?>>7.5</option>
            <option value="8" <?php echo $selected_8 ?>>8</option>
            <option value="9" <?php echo $selected_9 ?>>8.5</option>
            <option value="10" <?php echo $selected_10 ?>>9</option>
            <option value="11" <?php echo $selected_11 ?>>9.5</option>
            <option value="12" <?php echo $selected_12 ?>>10</option>
        </select>
    </div>
    <div class="form-group">
        <label for="summary">Mô tả ngắn sản phẩm</label>
        <textarea name="summary" id="summary"
                  class="form-control"><?php echo isset($_POST['summary']) ? $_POST['summary'] : '' ?></textarea>
    </div>
    <div class="form-group">
        <label for="description">Mô tả chi tiết sản phẩm</label>
        <textarea name="content" id="description"
                  class="form-control"><?php echo isset($_POST['content']) ? $_POST['content'] : '' ?></textarea>
    </div>
    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" class="form-control" id="status">
            <?php
            $selected_active = '';
            $selected_disabled = '';
            if (isset($_POST['status'])) {
                switch ($_POST['status']) {
                    case 0:
                        $selected_disabled = 'selected';
                        break;
                    case 1:
                        $selected_active = 'selected';
                        break;
                }
            }
            ?>
            <option value="0" <?php echo $selected_disabled; ?>>Disabled</option>
            <option value="1" <?php echo $selected_active ?>>Active</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
        <a href="index.php?controller=product&action=index" class="btn btn-default">Back</a>
    </div>
</form>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="avatar">Ảnh Sản phẩm</label>
        <input type="file" multiple name="avatar_file[]" value="" class="form-control" id="avatar"/>
    </div>
    <div class="form-group">
        <input type="submit" name="submit_file" value="Save" class="btn btn-primary"/>
        <a href="index.php?controller=product&action=index" class="btn btn-default">Back</a>
    </div>
</form>