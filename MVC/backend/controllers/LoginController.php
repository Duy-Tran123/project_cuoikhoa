<?php
require_once 'controllers/Controller.php';
require_once 'models/User.php';
class LoginController extends Controller{
    public function signup(){
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        if (isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            if (empty($username) || empty($password) ){
                $this->error = "Username hoặc password không đc để trống";
            }elseif ($password != $confirm_password){
                $this->error = "Password confirm chưa đúng";
            }
            if(empty($this->error)){
                $user_model = new User();
                $user = $user_model->getUser($username);
                if (!empty($user)){
                    $this->error = "Username đã tồn tại";
                }
                else{
                    $user_model->username = $username;
                    $user_model->password = md5($password);
                    $is_register = $user_model->register();
                    if ($is_register){
                        $_SESSION['success'] = "Đăng ký thành công";
                    }else{
                        $_SESSION['error'] = "Đăng ký thất bại";
                    }
                    header('Location:index.php?controller=login&action=login');
                    exit();
                }
            }
        }
        $this->content = $this->render('views/users/signup.php');
        require_once 'views/layouts/main_login.php';
    }
    public function login() {
        //xử lý submit form
        //debug thông tin mảng
        //luôn xử lý submit form trước đoạn code hiển thị view
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        if (isset($_POST['submit'])) {
            //gán biến
            $username = $_POST['username'];
            $password = $_POST['password'];
            //check validate
//            - ko đc để trống cả 2 trường
            if (empty($username) || empty($password)) {
                $this->error = 'Ko đc để trống username hoặc password';
            }
            //xử lý logic submit form chỉ khi nào ko có lỗi validate
            if (empty($this->error)) {
                //xử lý login thì thường sẽ tạo ra 1 session chứa
                //thông tin của user tìm được
                $user_model = new User();
                //do password lưu trong CSDL đang đc mã hóa
                //theo cơ chế md5
                $password = md5($password);
                //gọi phương thức lấy user từ csdl
                //dựa vào username và password đã mã hóa
                $user = $user_model
                    ->getUserLogin($username, $password);
                if (empty($user)) {
                    $_SESSION['error'] = 'Sai username hoặc password';
                    header
                    ('Location: index.php?controller=login&action=login');
                    exit();
                } else {
                    $_SESSION['success'] = 'Đăng nhập thành công';
                    //khi login thành công cần tạo session với giá trị
                    //chính là mảng user vừa tìm đc
                    $_SESSION['user'] = $user;
                    //chuyển hướng tới trang admin
                    header
                    ('Location: index.php?controller=category&action=index');
                    exit();
                }

            }
        }

        //lấy nội dung view login
        $this->content =
            $this->render('views/users/login.php');
        //gọi layout để hiển thị view
        require_once 'views/layouts/main_login.php';
    }
    public function logout() {
        //xóa tất cả các session liên quan đến user đã đăng nhập
        unset($_SESSION['user']);
        $_SESSION['success'] = 'Logout thành công';
        //chuyển hướng về trang login
        header
        ('Location: index.php?controller=login&action=login');
        exit();
    }
}