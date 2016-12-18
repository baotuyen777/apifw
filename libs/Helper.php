<?php

/**
 * Description of Helper
 *
 * @author michael
 */
class Helper {

    /**
     * 
     * @param type $data
     * @return type
     */
    static function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    function base64url_decode($data) {
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
            "exp" => time() + (24 * 60 * 60),
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
            $mes = "signature invalid!";
            $status = false;
            $data = new stdClass();
            if ($signature === self::encodeSignature($arrToken[0] . "." . $arrToken[1])) {
                $payload = json_decode(self::base64url_decode($arrToken[1]));
                if (time() > $payload->exp) {
                    $mes = "token is expire!";
                } else {
                    $status = true;
                    $data = $payload;
                    $mes = "check token success!";
                }
            }
            $result = array(
                "status" => $status,
                "data" => $data,
                "message" => $mes
            );
        } else {
            $result = array(
                "status" => false,
                "message" => "Please imput {token} in header!"
            );
        }

        return $result;
    }

}
