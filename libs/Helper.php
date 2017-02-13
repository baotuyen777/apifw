<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Helper {

    public $result;

    static function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    static function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    static private function encodeSignature($encodedContent) {
        return md5($encodedContent . "bearer");
    }

    /**
     * 
     * @return type
     */
    static function genarateToken($userId) {
        $arrHeader = array(
            "alg" => "HS256",
            "typ" => "JWT"
        );
        $header = self::base64url_encode(json_encode($arrHeader));
        $arrPayload = array(
            "iss" => "davidbui",
            "exp" => time() + (7 * 24 * 60 * 60),
            "user" => $userId
        );
        $payload = self::base64url_encode(json_encode($arrPayload));
        $encodedContent = $header . "." . $payload;
        $signature = self::encodeSignature($encodedContent);
        return $encodedContent . "." . $signature;
    }

    /**
     * 
     * @param type $token
     * @return type
     */
    static function checkToken() {
        $headers = apache_request_headers();
        $token = isset($headers['token']) ? $headers['token'] : false;
        $result = array(
            "status" => false,
            "message" => "Something wrong!"
        );
        if ($token) {
            $arrToken = explode(".", $token);
            $signature = ($arrToken[2]);
            $result["message"] = "token invalid!";
            $status = false;
            $data = new stdClass();
            if ($signature === self::encodeSignature($arrToken[0] . "." . $arrToken[1])) {
                $payload = json_decode(self::base64url_decode($arrToken[1]));
                if (time() > $payload->exp) {
                    $result["message"] = "token is expire!";
                } else {
                    $result["message"] = "check token success!";
                    $result["data"] = $payload;
                    $result["status"] = true;
                }
            }
        } else {
            $result["message"] = "Please imput {token} in header!";
        }
        return $result;
    }

    /**
     * 
     * @param type $id
     * @param type $table
     */
    static function checkId($table, $field, $val) {
        $result = array(
            "status" => false,
            'message' => "Some thing wrong",
        );
        if (!$val) {
            $result['message'] = "please input {id} in URL";
            return $result;
        }
        $sql = "SELECT {$field} FROM {$table} WHERE {$field}=:val ";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bindValue(":val", $val);
        $stmt->execute();
        if (!$stmt->fetchColumn()) {
            $result['message'] = "{$field} not found!";
            return $result;
        }
        $result = array(
            "status" => true,
            'message' => "200",
        );
        return $result;
    }

    static function sendMail($from,$subject,$content) {
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->IsSMTP();
//Tắt mở kiểm tra lỗi trả về, chấp nhận các giá trị 0 1 2
// 0 = off không thông báo bất kì gì, tốt nhất nên dùng khi đã hoàn thành.
// 1 = Thông báo lỗi ở client
// 2 = Thông báo lỗi cả client và lỗi ở server
        $mail->SMTPDebug = 0;

        $mail->Debugoutput = "html"; // Lỗi trả về hiển thị với cấu trúc HTML
        $mail->Host = "smtp.gmail.com"; //host smtp để gửi mail
        $mail->Port = 587; // cổng để gửi mail
        $mail->SMTPSecure = "tls"; //Phương thức mã hóa thư - ssl hoặc tls
        $mail->SMTPAuth = true; //Xác thực SMTP
        $mail->Username = MAIL_USERNAME; // Tên đăng nhập tài khoản Gmail
        $mail->Password = MAIL_PASSWORD; //Mật khẩu của gmail
        $mail->SetFrom(MAIL_USERNAME, MAIL_NAME); // Thông tin người gửi
        $mail->AddReplyTo(MAIL_USERNAME, MAIL_NAME); // Ấn định email sẽ nhận khi người dùng reply lại.
        $mail->AddAddress($from); //Email của người nhận
        $mail->Subject = $subject; //Tiêu đề của thư
        $mail->MsgHTML($content); //Nội dung của bức thư.
// Gửi thư với tập tin html
//        $mail->AltBody = "This is a plain-text message body"; //Nội dung rút gọn hiển thị bên ngoài thư mục thư.
//        $mail->AddAttachment("images/attact-tui.gif"); //Tập tin cần attach
//Tiến hành gửi email và kiểm tra lỗi
        if (!$mail->Send()) {
//            echo "Có lỗi khi gửi mail: " . $mail->ErrorInfo;
            return FALSE;
        }
        return true;
    }

}
