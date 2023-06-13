<?php

class SomeClass
{
    public function someSum($a, $b)
    {
        return $a + $b;
    }
}

class AnotherClass
{
    public function anotherSum($a, $b)
    {
        return $a + $b;
    }
}

trait TAdaptee
{
    public function sum(int $a, int $b)
    {
        $method = $this->method;
        return $this->$method($a, $b);
    }
}

class SomeAdaptee extends SomeClass
{
    use TAdaptee;
    private $method = 'someSum';
}

class AnotherAdaptee extends AnotherClass
{
    use TAdaptee;
    private $method = 'anotherSum';
}

$some = new SomeAdaptee;
$another = new AnotherAdaptee;
$some->sum(2,2);
$another->sum(5,2);