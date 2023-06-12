<?php

namespace advanced;

trait MultitonTrait
{
    private static $instances = [];

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

    static public function getInstance(string $instanceName)
    {
        if(isset(static::$instances[$instanceName])) {
            return static::$instances[$instanceName];
        }

        static::$instances[$instanceName] = new static();

        return static::$instance ?? (static::$instance = new static());
    }

}


class AdvancedMultiton
{
    use MultitonTrait;
    private static $instance;

}

print_r(AdvancedMultiton::getInstance('mysql'));
print_r(AdvancedMultiton::getInstance('mongo'));


print_r(AdvancedMultiton::getInstance('mysql'));
print_r(AdvancedMultiton::getInstance('mongo'));