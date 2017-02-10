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
            "exp" => time() + (7*24 * 60 * 60),
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
    

}
