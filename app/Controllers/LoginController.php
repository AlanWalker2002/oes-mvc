<?php

require_once './routes/RLogin.php';
require_once 'app/Models/Login.php';

class LoginController
{
    public function show_login()
    {
        $route = new RLogin();
        $route->show_login();
    }

    public function submit_login()
    {
        $result = array();
        if (isset($_POST['username'])) {
            $username = htmlspecialchars(addslashes($_POST['username']));
            $user = $this->get_username($username);
            if (!empty($user)) {
                $result['status_value'] = "💨 Nhập mật khẩu để tiếp tục...";
                $result['name'] = $user->name;
                $result['status'] = 1;
                $_SESSION['username'] = $user->username;
            } else {
                $result['status_value'] = "⚠ Tài khoản hoặc email không tồn tại!";
                $result['status'] = 0;
            }
        } else {
            $result['status_value'] = "Nhập tài khoản hoặc email!";
            $result['status'] = 0;
        }
        echo json_encode($result);
    }

    public function submit_password()
    {
        $result = array();
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (isset($_SESSION['username'])) {
            $user = $this->get_password($_SESSION['username']);
            if ($password == $user->password) {
                $result['status_value'] = "🎉 Đăng nhập thành công, chuẩn bị chuyển hưóng...";
                $result['status'] = 1;
                if ($user->permission_id == 1) {
                    $_SESSION['permission'] = "Admin";
                }
                if ($user->permission_id == 2) {
                    $_SESSION['permission'] = "Teacher";
                }
                if ($user->permission_id == 3) {
                    $_SESSION['permission'] = "Student";
                }
                $_SESSION['login'] = true;
            } else {
                $result['status_value'] = "❌ Sai mật khẩu!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    public function get_password($username)
    {
        $model = new Login();
        return $model->get_password($username);
    }

    public function get_username($username)
    {
        $model = new Login();
        return $model->get_username($username);
    }

    public function submit_forgot_password()
    {
        $result = array();
        $model = new Login();
        require_once 'res/libs/class.phpmailer.php';
        require_once 'res/libs/class.smtp.php';
        $username = isset($_POST['username']) ? Htmlspecialchars($_POST['username']) : '';
        $get = $this->reset_password($username);
        if ($get) {
            $password = $get->password;
            $nameTo = $get->name;
            $mailTo = $get->email;
            $mail = $this->send_mail($password, $nameTo, $mailTo);
            if ($mail) {
                $result['status_value'] = "Gửi email thành công. Kiểm tra hộp thư để lấy mật khẩu (có thể trong Spam)";
                $result['status'] = 1;
                $model->update_new_password(md5($password), $get->permission_id, $username);
            } else {
                $result['status_value'] = "Gửi email thất bại, vui lòng thử lại trong giây lát.";
                $result['status'] = 0;
            }
        } else {
            $result['status_value'] = "Tài khoản hoặc email không tồn tại, vui lòng thử lại.";
            $result['status'] = 0;
        }
        echo json_encode($result);
    }

    public function reset_password($username)
    {
        $model = new Login();
        return $model->reset_password($username);
    }

    public function send_mail($password, $nTo, $mTo)
    {
        $nFrom = 'IKun.Org';
        $mFrom = 'example@gmail.com';
        $mPass = 'example';
        $mail = new PHPMailer();
        $content = 'Đây là mật khẩu của bạn.<br /><b>' . $password . '</b><br />Hãy đổi ngay sau khi đăng nhập. <br />Đây là email gửi tự động, vui lòng không trả lời email này.';
        $body = $content;
        $mail->IsSMTP();
        $mail->CharSet  = "utf-8";
        $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                   // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        $mail->Username   = $mFrom;  // GMAIL username
        $mail->Password   = $mPass;              // GMAIL password
        $mail->SetFrom($mFrom, $nFrom);
        $title = 'Reset Mật Khẩu Trên Hệ Thống Trắc Nghiệm Online';
        $mail->Subject    = $title;
        $mail->MsgHTML($body);
        $address = $mTo;
        $mail->AddAddress($address, $nTo);
        $mail->AddReplyTo('noreply24@ikun.org', 'IKun.Org');
        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }
}
