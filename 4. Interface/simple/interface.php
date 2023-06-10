<?php
class A
{
    public function __construct()
    {
        echo "Логика класса A\n";
    }
}

class B
{
    public function __construct()
    {
        echo "Логика класса B\n";
    }
}

class C
{
    public function __construct()
    {
        echo "Логика класса С\n";
    }
}

class Example
{
    public static function run() {
        new A;
        new B;
        new C;
    }
}

// Вызов интерфейса
Example::run();