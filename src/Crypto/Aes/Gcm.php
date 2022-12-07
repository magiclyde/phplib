<?php

namespace Magiclyde\Phplib\Crypto\Aes;

class Gcm
{
    static public function encrypt($plaintext, $key, $algo = 'aes-128-gcm')
    {
        $key = hex2bin($key);

        $iv_len = openssl_cipher_iv_length($algo);
        $iv = openssl_random_pseudo_bytes($iv_len);

        $tag = null;
        $ciphertext = openssl_encrypt($plaintext, $algo, $key, OPENSSL_RAW_DATA, $iv, $tag);

        return base64_encode($iv . $ciphertext . $tag);
    }

    static public function decrypt($b64s, $key, $algo = 'aes-128-gcm')
    {
        $key = hex2bin($key);

        $str = base64_decode($b64s);
        $str_len = strlen($str);

        $iv_len = openssl_cipher_iv_length($algo);
        $iv = substr($str, 0, $iv_len);

        $tag_len = 128 / 8;
        $tag = substr($str, $str_len - $tag_len, $tag_len);

        $ciphertext = substr($str, $iv_len, $str_len - $iv_len - $tag_len);

        return openssl_decrypt($ciphertext, $algo, $key, OPENSSL_RAW_DATA, $iv, $tag);
    }

}