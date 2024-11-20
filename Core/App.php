<?php

namespace Core;

use Exception;

class App
{
    protected static Container $container;

    public static function setContainer($container): void
    {
        static::$container = $container;
    }

    public static function getContainer(): Container
    {
        return static::$container;
    }

    public static function retrieve($key)
    {
        try {
            return static::getContainer()->resolve($key);
        } catch (Exception $exception) {
            echo $exception->getMessage();
            die();
        }
    }
}
