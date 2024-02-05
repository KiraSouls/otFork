<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitea5ebff16a50426a08ae4b67c8f3c228
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitea5ebff16a50426a08ae4b67c8f3c228', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitea5ebff16a50426a08ae4b67c8f3c228', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitea5ebff16a50426a08ae4b67c8f3c228::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
