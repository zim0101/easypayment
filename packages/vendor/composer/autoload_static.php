<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf07ab9e9106d3d3728e9ace6fa4abae6
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PayWayDev\\EasyPayment\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PayWayDev\\EasyPayment\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/payWayDev/easyPayment/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf07ab9e9106d3d3728e9ace6fa4abae6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf07ab9e9106d3d3728e9ace6fa4abae6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}