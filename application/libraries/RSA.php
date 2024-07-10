<?php

/**
 * Class Rsa 对称加密
 * version : (PHP 4 >= 4.0.6, PHP 5, PHP 7)
 * 生成私钥：openssl genrsa -out private_key.pem 2048
 * 生成公钥：openssl rsa -in private_key.pem -pubout -out public_key.pem
 */
class Rsa
{
    //private static $PUBLIC_KEY  = 'public_key.pem 内容';
    //private static $PRIVATE_KEY = 'private_key.pem 内容';


    private static $PUBLIC_KEY  = '-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAoqJAhb9tB8/BJ04QN4iYq1nwudD6iEWf65PvO2Q9X35MZjYBbwGYvyAV7rf+Fkjo3lNvk3LI8b7jpc6PqtYSByo7vfi8+nUT2sxzHBnv63c2sOabjcKYueaRYYAG7F4wZRVKLo+d/E3cJVJqCkLFh0euKqELcI+c4IIJwqvCjxZCdw8locceSghHdyRNwOHdZQiYEXoOHMDEZZXFv5as7vVVfSny3oO/IX74d4MUa6IXRysY1wQ4Pcw/1ev1uS8RT47PzKQsyV5znTtLD1zUEzlxIl2ZPq46cScdgcuAyBVQQUCGEm+Wp3ff/0x4H07oIVTvYjgwo7xtRodpkJCGGrsVdxVlIsZQGOOMh7U/nbqTU76TzElwXzwM+7Qw27lER1E7NSRjspC/GPXsFb6Y81XSQMszZBPDf4WeBU8da84XPUcfORUqjG6UdtB3z/dGvfVWJm+4vecuAJy+qyrMJ8KpoBXGHyay09PAfsS2WsOEOzPvGblvROmTL+al6tEPup6p4BJAOy6DvkILqfPpyqoR9ECMgofn1PgkcXJr5u5OG8n50mJ3Epu3XR4pniw+vfi9K1Skocq4/Z+lENNOj+G93/jUOFoM3CERsNhRvv+X7R+TuGYzmIMkPIGwfEUvviJtQyz/+9xwgXZl1164NZnAjgquEprbTV+AhOQQ8j8CAwEAAQ==
-----END PUBLIC KEY-----';

    private static $PRIVATE_KEY = '-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----';

    /**
     * 获取私钥
     * @return bool|resource
     */
    private static function getPrivateKey()
    {
        $privateKey = self::$PRIVATE_KEY;
        return openssl_pkey_get_private($privateKey);
    }

    /**
     * 获取公钥
     * @return bool|resource
     */
    private static function getPublicKey()
    {
        $publicKey = self::$PUBLIC_KEY;
        return openssl_pkey_get_public($publicKey);
    }

    /**
     * 私钥加密
     * @param string $data
     * @return null|string
     */
    public static function privateEncrypt($data = '')
    {
        if (!is_string($data)) {
            return null;
        }
        return openssl_private_encrypt($data,$encrypted,self::getPrivateKey()) ? base64_encode($encrypted) : null;
    }

    /**
     * 公钥加密
     * @param string $data
     * @return null|string
     */
    public static function publicEncrypt($data = '')
    {
        if (!is_string($data)) {
            return null;
        }
        return openssl_public_encrypt($data,$encrypted,self::getPublicKey()) ? base64_encode($encrypted) : null;
    }

    /**
     * 私钥解密
     * @param string $encrypted
     * @return null
     */
    public static function privateDecrypt($encrypted = '')
    {
        if (!is_string($encrypted)) {
            return null;
        }
        return (openssl_private_decrypt(base64_decode($encrypted), $decrypted, self::getPrivateKey())) ? $decrypted : null;
    }

    /**
     * 公钥解密
     * @param string $encrypted
     * @return null
     */
    public static function publicDecrypt($encrypted = '')
    {
        if (!is_string($encrypted)) {
            return null;
        }
        return (openssl_public_decrypt(base64_decode($encrypted), $decrypted, self::getPublicKey())) ? $decrypted : null;
    }

    /**
     * 创建签名
     * @param string $data 数据
     * @return null|string
     */
    public function createSign($data = '')
    {
        if (!is_string($data)) {
            return null;
        }
        return openssl_sign($data, $sign, self::getPrivateKey(), OPENSSL_ALGO_SHA256) ? base64_encode($sign) : null;
    }

    /**
     * 验证签名
     * @param string $data 数据
     * @param string $sign 签名
     * @return bool
     */
    public function verifySign($data = '', $sign = '')
    {
        if (!is_string($sign) || !is_string($sign)) {
            return false;
        }
        return (bool)openssl_verify($data, base64_decode($sign), self::getPublicKey(), OPENSSL_ALGO_SHA256);
    }
}

// $rsa = new Rsa();
// $data = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto tenetur amet vitae sint voluptatem accusamus officiis. Enim nam quia tenetur delectus, recusandae, impedit velit molestias odit obcaecati eaque sequi neque.';
// echo 'Text : '.$data.'<br><br>';

// $privateEncrypt = $rsa->privateEncrypt($data);
// echo 'Enkcript : '.$privateEncrypt.'<br>';

// $publicDecrypt = $rsa->publicDecrypt($privateEncrypt);
// echo 'Decyrpt : '.$publicDecrypt.'<br><br>';

// $publicEncrypt = $rsa->publicEncrypt($data);
// echo 'Public Encrypt : '.$publicEncrypt.'<br>';

// $privateDecrypt = $rsa->privateDecrypt($publicEncrypt);
// echo 'Private Decyrypt : '.$privateDecrypt.'<br><br>';

// $sign = $rsa->createSign($data);
// echo 'Sign : '.$sign.'<br>';

// $status = $rsa->verifySign($data, $sign);
// echo 'Status : '.($status) ? 'true' : 'false' ;