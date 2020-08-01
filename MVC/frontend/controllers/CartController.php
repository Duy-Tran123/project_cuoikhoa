<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
 class CartController extends Controller{
     public function add(){
//         echo "<pre>";
//         print_r($_GET);
//         echo "</pre>";
         $id = $_GET['id'];
         $product_model = new Product();
         $product = $product_model->getById($id);
//         echo "<pre>";
//         print_r($product);
//         echo "</pre>";
         $cart1 = [
             'name' => $product['title'],
             'price' => $product['price'],
             'avatar' => $product['avatar'],
             'quality' => 1
         ];
         if (!isset($_SESSION['cart1'])){
             $_SESSION['cart1'][$id] = $cart1;
         }else{
             if (!array_key_exists($id,$_SESSION['cart1'])){
                 $_SESSION['cart1'][$id] = $cart1;
             }else{
                 $_SESSION['cart1'][$id]['quality']++;
             }
         }
         $url_redirect = $_SERVER['SCRIPT_NAME'].'/gio-hang-cua-ban';
         header("Location:$url_redirect");
         exit();
     }
     public function index(){
//         echo "<pre>";
//         print_r($_POST);
//         echo "</pre>";
         if (isset($_POST['submit'])){
             foreach ($_SESSION['cart1'] AS $product_id => $cart1){
                 $_SESSION['cart1'][$product_id]['quality'] = $_POST[$product_id];
             }
             $_SESSION['success'] = "Update cart success";
         }
         $this->content = $this->render('views/carts/index.php');
         require_once 'views/layouts/main.php';
     }
     public function delete(){
         $product_id = $_GET['id'];
         unset($_SESSION['cart1'][$product_id]);
         if (empty($_SESSION['cart1'])){
             unset($_SESSION['cart1']);
         }
         $_SESSION['success'] = "Delete product success";
         $url_redirect = $_SERVER['SCRIPT_NAME'] . '/gio-hang-cua-ban';
         header("Location: $url_redirect");
         exit();
     }
 }