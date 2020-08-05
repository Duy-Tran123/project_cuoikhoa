<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/30/2020
 * Time: 11:03 PM
 */
require_once "controllers/Controller.php";
require_once "models/Order.php";

class OrderController extends Controller
{
    public function index(){
        $obj_order = new Order();
        $orders = $obj_order->getAll();
        if ($orders) {
            $_SESSION['success'] = 'Thêm mới thành công';
        } else {
            $_SESSION['error'] = 'Thêm mới thất bại';
        }
        $this->content = $this->render('views/order/index.php',
            [
                'orders' => $orders
            ]);
        require_once 'views/layouts/main.php';
    }
}