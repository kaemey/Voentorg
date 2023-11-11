<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit08b1ac17918c7df16451fb7f7cf3c700
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit08b1ac17918c7df16451fb7f7cf3c700::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit08b1ac17918c7df16451fb7f7cf3c700::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit08b1ac17918c7df16451fb7f7cf3c700::$classMap;

        }, null, ClassLoader::class);
    }
}
