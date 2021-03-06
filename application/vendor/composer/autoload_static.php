<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3c6da3aa1d84f1436fa699b050c971bc
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'League\\Plates\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3c6da3aa1d84f1436fa699b050c971bc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3c6da3aa1d84f1436fa699b050c971bc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
