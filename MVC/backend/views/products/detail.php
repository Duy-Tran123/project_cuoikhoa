<?php
require_once 'helpers/Helper.php';
?>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $product['id']?></td>
    </tr>
    <tr>
        <th>Category name</th>
        <td><?php echo $product['category_name']?></td>
    </tr>
    <tr>
        <th>Title</th>
        <td><?php echo $product['title']?></td>
    </tr>
    <tr>
        <th>Avatar</th>
        <td>
            <?php if (!empty($product['avatar'])): ?>
                <img height="80" src="assets/uploads/<?php echo $product['avatar'] ?>"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Price</th>
        <td><?php echo number_format($product['price']) ?></td>
    </tr>
    <tr>
        <th>Price</th>
        <td><?php echo number_format($product['price_discount']) ?></td>
    </tr>
    <tr>
        <th>Price</th>
        <td><?php
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
    </tr>
    <tr>
        <th>Status</th>
        <td><?php echo Helper::getStatusText($product['status']) ?></td>
    </tr>
    <tr>
        <th>Created at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($product['created_at'])) ?></td>
    </tr>
    <tr>
        <th>Updated at</th>
        <td><?php echo !empty($product['updated_at']) ? date('d-m-Y H:i:s', strtotime($product['updated_at'])) : '--' ?></td>
    </tr>
</table>
<a href="index.php?controller=product&action=index" class="btn btn-default">Back</a>