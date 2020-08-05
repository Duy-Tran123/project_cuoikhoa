<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';
//nhúng các file liên quan đến thư viên PHPMailer để gửi mail
require_once 'configs/PHPMailer/src/PHPMailer.php';
require_once 'configs/PHPMailer/src/SMTP.php';
require_once 'configs/PHPMailer/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class PaymentController extends Controller{
    public function index()
    {
        //xử lý submit form khi user click THanh toán
        //debug thông tin mảng $_POST
        //nếu user click nút Thanh toán/submit form thì mới xử lý
        if (isset($_POST['submit'])) {
            //gán biến trung gian cho dễ thao tác
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $note = $_POST['note'];
            //phương thức thanh toán, = 0 -> thanh toán trực tuyến
            // = 1 thì thanh toán COD
            $method = $_POST['method'];
            //check validate: fullname, address, mobile ko đc
            //để trống
            if (empty($fullname) || empty($address) || empty($mobile)) {
                $this->error = 'Fullname, address, mobile ko đc để trống';
            }
            //chỉ xử lý logic submit form khi ko có lỗi xảy ra
            if (empty($this->error)) {
                //ko quan tâm đến phương thức thanh toán đang là Trực tuyến
                //hay COD, mà sẽ lưu đơn hàng luôn
                $order_model = new Order();
                $order_model->fullname = $fullname;
                $order_model->address = $address;
                $order_model->mobile = $mobile;
                $order_model->note = $note;
                $order_model->email = $email;
                //tính tổng giá trị đơn hàng cho trường price_total
                //trong bảng orders
                $price_total = 0;
                //lặp giỏ hàng, cộng dồn biến $price_total này với giá
                //thành tiền của các sản phẩm tương ứng trong giỏ
                foreach ($_SESSION['cart1'] AS $cart1) {
                    $price_item = $cart1['price'] * $cart1['quality'];
                    $price_total += $price_item;
                }
                $order_model->price_total = $price_total;
                //trạng thái thanh toán đơn hàng, mặc định ban đầu trạng
                //thái sẽ là chưa thanh toán, trường payment_status trong
                //bảng order đang có kiểu dữ liệu là TINYINT
                $order_model->payment_status = 0;
                //                //thực tế sẽ có bộ phận sales sẽ quản lý các đơn
                //                //hàng, liên hệ với user đã đặt hàng, sau đó khi
                //                //nhận đc tiền từ KH thì sẽ cập nhật lại trường
                //                //payment_status này thành Đã thanh toán

                $order_id = $order_model->insert();

                //nếu order_id > 0 thì chắc chắn đã lưu đc vào
                //bảng orders r
                if ($order_id > 0) {
                    //lưu các thông tin vào bảng order_details
                    //lặp giỏ hàng để lưu thông tin từng phần tử
                    //vào bảng
                    $order_detail_model = new OrderDetail();
                    $order_detail_model->order_id = $order_id;
                    foreach ($_SESSION['cart1'] AS $product_id => $cart1) {
                        $order_detail_model->product_id = $product_id;
                        $order_detail_model->quality = $cart1['quality'];
                        $is_insert = $order_detail_model->insert();

                    }

                    //dựa vào phương thức thanh toán để quyết định
                    //sẽ làm gì
                    //nếu là thanh toán trực tuyến
                    if ($method == 0) {
                        //tạo session  lưu các thông tin liên quan
                        //đến đơn hàng, để hiển thị ra tại trang thanh toán
                        //Phương pháp:
                        $_SESSION['order'] = [
                            'price_total' => $price_total,
                            'fullname' => $fullname,
                            'email' => $email,
                            'mobile' => $mobile
                        ];
                        //chuyển hướng về trang tích hợp ngân lượng
                        $url_redirect =
                            $_SERVER['SCRIPT_NAME'] . '/thanh-toan-truc-tuyen';
                        header("Location: $url_redirect");
                        exit();
                    }
                    else {
                        //thực hiện gửi mail xác nhận đơn hàng
                        $this->sendMail($email);
                        //xóa session giỏ hàng
                        unset($_SESSION['cart1']);
                        //chuyển hướng về trang cám ơn
                        $url_redirect = $_SERVER['SCRIPT_NAME'] . '/cam-on';
                        header("Location: $url_redirect");
                        exit();
                    }
                }
            }
        }


        //lấy nội dung view index tương ứng
        $this->content =
            $this->render('views/payments/index.php');
        //gọi layout để hiển thị nội dung view vừa lấy đc
        require_once 'views/layouts/main.php';
    }

    public function sendMail($email)
    {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            //thêm dòng sau để hiển thị đc ký tự có dấu
            $mail->CharSet = 'UTF-8';
            //thực tế sẽ sử dụng DEBUG_OFF để bỏ việc debug gửi mail
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            //sử dụng server gmail để gửi mail
            $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            //nhập tài khoản gmail cho username
            //tạm thời dùng tài khoản sau để
            // đỡ mất thời gian Xác minh 2 bươc
            $mail->Username = 'nguyenvietmanhit@gmail.com';                     // SMTP username
            //password ko phải là pasword gmail, mà gmail có 1 cơ chế
            //tạo password cho các ứng dụng, password này độc lập với
            //password gmail của bạn
            $mail->Password = 'eveoishoiioelqdg';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            //gửi từ ai
            $mail->setFrom('abc@gmail.com', 'Gui tu Manh');
            //gửi tới ai
            $mail->addAddress($email);     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

            // Attachments
            //đính kèm file muốn gửi cùng mail
//            $mail->addAttachment('image.jpeg');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Tiêu đề gửi mail';
            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    public function thank()
    {
        $this->content =
            $this->render('views/payments/thank.php');
        require_once 'views/layouts/main.php';
    }

    public function online()
    {
        $this->content =
            $this->render('configs/nganluong/index.php');
        echo $this->content;
    }
}