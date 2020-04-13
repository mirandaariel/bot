<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2988bf8018b3eb98d7f5af05c652ce0a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'J' => 
        array (
            'Jose\\Component\\Signature\\Algorithm\\' => 35,
            'Jose\\Component\\Signature\\' => 25,
            'Jose\\Component\\KeyManagement\\' => 29,
            'Jose\\Component\\Core\\' => 20,
        ),
        'F' => 
        array (
            'FG\\' => 3,
        ),
        'B' => 
        array (
            'Base64Url\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Jose\\Component\\Signature\\Algorithm\\' => 
        array (
            0 => __DIR__ . '/..' . '/web-token/jwt-signature-algorithm-ecdsa',
            1 => __DIR__ . '/..' . '/web-token/jwt-signature-algorithm-hmac',
        ),
        'Jose\\Component\\Signature\\' => 
        array (
            0 => __DIR__ . '/..' . '/web-token/jwt-signature',
        ),
        'Jose\\Component\\KeyManagement\\' => 
        array (
            0 => __DIR__ . '/..' . '/web-token/jwt-key-mgmt',
        ),
        'Jose\\Component\\Core\\' => 
        array (
            0 => __DIR__ . '/..' . '/web-token/jwt-core',
        ),
        'FG\\' => 
        array (
            0 => __DIR__ . '/..' . '/fgrosse/phpasn1/lib',
        ),
        'Base64Url\\' => 
        array (
            0 => __DIR__ . '/..' . '/spomky-labs/base64url/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2988bf8018b3eb98d7f5af05c652ce0a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2988bf8018b3eb98d7f5af05c652ce0a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}