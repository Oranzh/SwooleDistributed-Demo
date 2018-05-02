<?php

/**
 * @param $data 需要加密的数据(除资源类型外的所有类型)
 * @param $public_key   公钥
 * @param bool $serialize  是否序列化(除Str外的都需序列化,如果是String可不序列化,节省时间)
 *      https://wiki.swoole.com/wiki/page/p-serialize.html
 * @param string $method
 * @return array
 */
function encode_aes($data,$public_key,$serialize = false,$method = 'aes-256-cbc') {
    if($serialize) $data = serialize($data);
    $key = password_hash($public_key, PASSWORD_BCRYPT, ['cost' => 12]);
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    secho('data',$data);
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





