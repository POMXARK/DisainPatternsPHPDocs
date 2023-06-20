<?php

abstract class Animal
{
    abstract static function makeSound();
}

class Dog extends Animal
{
    public static function makeSound(): void
    {
        self::bark();
    }

    public static function bark()
    {
        echo "Woof \n";
    }
}

class Cat extends Animal
{
    public static function makeSound(): void
    {
        self::meow();
    }

    public static function meow()
    {
        echo "Meow \n";
    }
}

class AnimalTest
{
    public static function main(): void
    {
        $at = new AnimalTest();
        $at->makeSomeAnimals();
    }

    public function makeSomeAnimals()
    {
        $dog = new Dog();
        $cat = new Cat();

        // treat dogs and cats as their supertype, Animal
        $animals = [];
        $animals[] = $dog;
        $animals[] = $cat;

        foreach ($animals as $animal) {
            $animal::makeSound(); // can call makeSound on any Animal
        }
    }
}

AnimalTest::main();