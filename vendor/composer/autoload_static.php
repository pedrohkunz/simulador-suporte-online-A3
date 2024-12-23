<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit11bedfbbe9e91d116efd9c45b538d01c
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'src\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit11bedfbbe9e91d116efd9c45b538d01c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit11bedfbbe9e91d116efd9c45b538d01c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit11bedfbbe9e91d116efd9c45b538d01c::$classMap;

        }, null, ClassLoader::class);
    }
}
