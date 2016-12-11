<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function encodeSignature($encodedContent) {
    return md5($encodedContent . "bearer");
}

function createToken() {
    $arrHeader = array(
        "alg" => "HS256",
        "typ" => "JWT"
    );
    $header = base64url_encode(json_encode($arrHeader));
    $arrPayload = array(
        "iss" => "davidbui",
        "exp" => time() + (24 * 60 * 60),
        "user" => "12"
    );
    $payload = base64url_encode(json_encode($arrPayload));
    $encodedContent = $header . "." . $payload;
    $signature = encodeSignature($encodedContent);
    return $encodedContent . "." . $signature;
}

function checkToken($token) {
    $arrToken = explode(".", $token);
    $signature = ($arrToken[2]);
    $mes = "signature invalid!";
    $status = false;
    $data = new stdClass();
    if ($signature === encodeSignature($arrToken[0] . "." . $arrToken[1])) {
        $payload = json_decode(base64url_decode($arrToken[1]));
        if (time() > $payload->exp) {
            $mes = "token is expire!";
        } else {
            $status = true;
            $data = $payload;
        }
    }
    return array(
        "status" => $status,
        "data" => $data,
        "mes" => $mes
    );
}

$token = createToken();
echo $token;
echo "<hr/>";
$user = checkToken($token);
var_dump($user);
echo "<hr/>";


echo "<hr/>";
