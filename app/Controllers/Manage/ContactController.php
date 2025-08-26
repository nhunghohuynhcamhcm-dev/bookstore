<?php
class ContactController {
    public function index() {
        require_once 'views/contact/index.php';
    }

    public function send() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name    = trim($_POST['name']);
            $email   = trim($_POST['email']);
            $message = trim($_POST['message']);

            // Email admin
            $to = "admin@example.com"; 
            $subject = "Liên hệ từ: " . $name;
            $headers = "From: $email\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";

            $body = "
                <h3>Thông tin liên hệ</h3>
                <p><b>Họ tên:</b> $name</p>
                <p><b>Email:</b> $email</p>
                <p><b>Nội dung:</b><br>$message</p>
            ";

            if (mail($to, $subject, $body, $headers)) {
                $success = "Gửi liên hệ thành công!";
            } else {
                $error = "Không gửi được email, vui lòng thử lại.";
            }

            require_once 'views/contact/index.php';
        }
    }
}
