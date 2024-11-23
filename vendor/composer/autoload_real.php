<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit11bedfbbe9e91d116efd9c45b538d01c
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit11bedfbbe9e91d116efd9c45b538d01c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit11bedfbbe9e91d116efd9c45b538d01c', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit11bedfbbe9e91d116efd9c45b538d01c::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
