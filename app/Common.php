<?php

/**
 * @param $data 需要加密的数据(除类型)
 * @param $key   公钥
 * @param bool $serialize  是否序列化(除Str外的都需序列化,如果是String可不序列化,节省时间)
 * @param string $method
 * @return array
 */
function encode_aes($data,$key,$serialize = false,$method = 'aes-256-cbc') {
    if($serialize) $data = serialize($data);
    $key = password_hash($key, PASSWORD_BCRYPT, ['cost' => 12]);
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    $encrypted = base64_encode(openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv));
    return [
        'hash_key' => $key,
        'encrypted' => $encrypted,
    ];
}

/**
 * @param $data
 * @param $key
 * @param bool $serialize
 * @param string $method
 * @return mixed|string
 */
function decode_aes($data,$key,$serialize = false,$method = 'aes-256-cbc') {
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    $decrypted = openssl_decrypt(base64_decode($data), $method, $key, OPENSSL_RAW_DATA, $iv);
    if($serialize)  $decrypted = unserialize($decrypted);
    return $decrypted;
}




