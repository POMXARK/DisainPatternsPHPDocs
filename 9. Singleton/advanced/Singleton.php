<?php

namespace advanced;

trait SingletonTrait
{
    private static $instance = null;

    /**
     * Запрещаем прямое создание
     */
    private function __construct()
    {
        //
    }

    /**
     * Запрещаем клонирование
     */
    private function __clone()
    {
        //
    }

    /**
     * Запрещаем десириализацию
     */
    private function __wakeup(): void
    {
        //
    }

    static public function getInstance()
    {
        return static::$instance ?? (static::$instance = new static());
    }

}


class AdvancedSingleton
{
    use SingletonTrait;
    private static $instance;

}

print_r(Singleton::getInstance());
print_r(Singleton::getInstance());
