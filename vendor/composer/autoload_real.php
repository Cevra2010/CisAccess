<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc14b5000293cf9f7eb0bef509e43a611
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

        spl_autoload_register(array('ComposerAutoloaderInitc14b5000293cf9f7eb0bef509e43a611', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitc14b5000293cf9f7eb0bef509e43a611', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitc14b5000293cf9f7eb0bef509e43a611::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
