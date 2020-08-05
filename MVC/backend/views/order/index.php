<h1>Danh sách category</h1>
<a href="index.php?controller=category&action=create" class="btn btn-primary">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>User_id</th>
        <th>FullName</th>
        <th>Adress</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Note</th>
        <th>Price_total</th>
        <th>Payment_status</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th></th>
    </tr>
    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td>
                    <?php echo $order['id']; ?>
                </td>
                <td>
                    <?php echo $order['user_id']; ?>
                </td>
                <td>
                    <?php echo $order['fullname']; ?>
                </td>
                <td>
                    <?php echo $order['address']; ?>
                </td>
                <td>
                    <?php echo $order['mobile']; ?>
                </td>
                <td>
                    <?php echo $order['email']; ?>
                </td>
                <td>
                    <?php echo $order['note']; ?>
                </td>
                <td>
                    <?php echo $order['price_total']; ?>
                </td>
                <td>
                    <?php
                    $status_text = 'Active';
                    if ($order['payment_status'] == 0) {
                        $status_text = 'Disabled';
                    }
                    echo $status_text;
                    ?>
                </td>
                <td>
                    <?php echo date('d-m-Y H:i:s', strtotime($order['created_at'])); ?>
                </td>
                <td>
                    <?php
                    if (!empty($category['updated_at'])) {
                        echo date('d-m-Y H:i:s', strtotime($order['updated_at']));
                    }
                    ?>
                </td>

            </tr>
        <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="7">Không có bản ghi nào</td>
        </tr>
    <?php endif; ?>
</table>