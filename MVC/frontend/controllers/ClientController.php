<?php
require_once 'controllers/Controller.php';
require_once 'models/Contact.php';
class ClientController extends Controller{
    public function index(){
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        if (isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $note = $_POST['note'];
        }
        if (empty($name)||empty($email)){
            $this->error = "Vui lòng nhập name và email";
        }
        if (empty($this->error)){
            $order_model = new Contact();
            $order_model->username = $name;
            $order_model->note = $note;
            $order_model->email = $email;
            $is_insert = $order_model->insert();
            var_dump($is_insert);
            if ($is_insert) {
                $_SESSION['success'] = 'Lưu thành công';
            } else {
                $_SESSION['error'] = 'Thêm mới thất bại';
            }
            $url_redirect = $_SERVER['SCRIPT_NAME'] . '/cam-on';
            header("Location: $url_redirect");
            exit();
        }
        $this->content =
            $this->render('views/contact/index.php');
        require_once 'views/layouts/main.php';

    }
}