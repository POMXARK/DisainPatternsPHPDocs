<?php
class Singleton
{
    private static $instance;

    static public function getInstance()
    {
        return static::$instance ?? (static::$instance = new static());
    }
}

print_r(Singleton::getInstance());
print_r(Singleton::getInstance());
