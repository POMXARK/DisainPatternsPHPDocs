<?php

abstract class Pizza
{
    protected $description = "Basic Pizza";

    public function getDescription(): string
    {
		return $this->description;
	}

    public abstract function cost();
}

abstract class ToppingDecorator extends Pizza
{
    protected $pizza;
}

class Cheese extends ToppingDecorator
{
    public function __construct(Pizza $pizza)
    {
		$this->pizza = $pizza;
	}

    public function getDescription(): string
    {
		return $this->pizza->getDescription() . ", Cheese";
	}

	public function cost()
    {
		return $this->pizza->cost(); // cheese is free
	}
}

class Olives extends ToppingDecorator
{
    public function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
    }

    public function getDescription(): string
    {
        return $this->pizza->getDescription() . ", Olives";
    }

    public function cost(): float
    {
        return $this->pizza->cost() + .30; // cheese is free
    }
}

class ThickcrustPizza extends Pizza
{
    public function __construct()
    {
		$this->description = "Thick crust pizza, with tomato sauce";
	}

    public function cost(): float
    {
		return 7.99;
	}
}

class ThincrustPizza extends Pizza
{
    public function __construct()
    {
        $this->description = "Thin crust pizza, with tomato sauce";
    }

    public function cost(): float
    {
        return 7.99;
    }
}

class PizzaStore
{
    public static function  main(): void
    {
        $pizza = new ThincrustPizza();
        $cheesePizza = new Cheese($pizza);
        $greekPizza = new Olives($cheesePizza);

        echo $greekPizza->getDescription() . " $" . $greekPizza->cost();
	}
}

PizzaStore::main();