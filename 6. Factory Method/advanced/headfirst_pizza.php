<?php

abstract class Pizza
{
    protected $name;
    protected $dough;
    protected $sauce;
    protected $toppings = [];

    public function prepare()
    {
        echo "Prepare " . $this->name . "\n";
        echo "Tossing dough..." . "\n";
        echo "Adding sauce..." . "\n";
        echo "Adding toppings: " . "\n";
        echo "Tossing dough..." . "\n";
        foreach ($this->toppings as $topping)
        {
            echo "   " . $topping . "\n";
        }
    }

    public function bake()
    {
        echo "Bake for 25 minutes at 350" . "\n";
	}

    public function cut()
    {
        echo "Cut the pizza into diagonal slices" . "\n";
	}

    public function box()
    {
        echo "Place pizza in official PizzaStore box" . "\n";
	}

	public function getName()
    {
		return $this->name;
	}
}

class ChicagoStyleCheesePizza extends Pizza
{
    public function __construct()
    {
		$this->name = "Chicago Style Deep Dish Cheese Pizza";
        $this->dough = "Extra Thick Crust Dough";
        $this->sauce = "Plum Tomato Sauce";

        $this->toppings[] = "Shredded Mozzarella Cheese";
	}

    public function cut()
    {
        echo "Cutting the pizza into square slices \n";
    }
}

class ChicagoStyleClamPizza extends Pizza
{
    public function __construct()
    {
        $this->name = "Chicago Style Clam Pizza";
        $this->dough = "Extra Thick Crust Dough";
        $this->sauce = "Plum Tomato Sauce";

        $this->toppings[] = "Shredded Mozzarella Cheese";
        $this->toppings[] = "Frozen Clams from Chesapeake Bay";
	}

    public function cut()
    {
        echo "Cutting the pizza into square slices \n";
    }
}

class ChicagoStylePepperoniPizza extends Pizza
{
    public function __construct()
    {
        $this->name = "Chicago Style Pepperoni Pizza";
        $this->dough = "Extra Thick Crust Dough";
        $this->sauce = "Plum Tomato Sauce";

        $this->toppings[] = "Shredded Mozzarella Cheese";
        $this->toppings[] = "Black Olives";
        $this->toppings[] = "Spinach";
        $this->toppings[] = "Eggplant";
        $this->toppings[] = "Sliced Pepperoni";
    }

    public function cut()
    {
        echo "Cutting the pizza into square slices \n";
    }
}

class ChicagoStyleVeggiePizza extends Pizza
{
    public function __construct()
    {
        $this->name = "Chicago Deep Dish Veggie Pizza";
        $this->dough = "Extra Thick Crust Dough";
        $this->sauce = "Plum Tomato Sauce";

        $this->toppings[] = "Shredded Mozzarella Cheese";
        $this->toppings[] = "Black Olives";
        $this->toppings[] = "Spinach";
        $this->toppings[] = "Eggplant";
    }

    public function cut()
    {
        echo "Cutting the pizza into square slices \n";
    }
}

class NYStyleCheesePizza extends Pizza
{
    public function __construct()
    {
        $this->name = "NY Style Sauce and Cheese Pizza";
        $this->dough = "Thin Crust Dough";
        $this->sauce = "Marinara Sauce";

        $this->toppings[] = "Grated Reggiano Cheese";
    }
}

class NYStyleClamPizza extends Pizza
{
    public function __construct()
    {
        $this->name = "NY Style Clam Pizza";
        $this->dough = "Thin Crust Dough";
        $this->sauce = "Marinara Sauce";

        $this->toppings[] = "Grated Reggiano Cheese";
        $this->toppings[] = "Fresh Clams from Long Island Sound";
    }
}

class NYStylePepperoniPizza extends Pizza
{
    public function __construct()
    {
        $this->name = "NY Style Pepperoni Pizza";
        $this->dough = "Thin Crust Dough";
        $this->sauce = "Marinara Sauce";

        $this->toppings[] = "Grated Reggiano Cheese";
        $this->toppings[] = "Sliced Pepperoni";
        $this->toppings[] = "Garlic";
        $this->toppings[] = "Onion";
        $this->toppings[] = "Mushrooms";
        $this->toppings[] = "Red Pepper";
    }
}

class NYStyleVeggiePizza extends Pizza
{
    public function __construct()
    {
        $this->name = "NY Style Veggie Pizza";
        $this->dough = "Thin Crust Dough";
        $this->sauce = "Marinara Sauce";

        $this->toppings[] = "Grated Reggiano Cheese";
        $this->toppings[] = "Garlic";
        $this->toppings[] = "Onion";
        $this->toppings[] = "Mushrooms";
        $this->toppings[] = "Red Pepper";
    }
}

/**
 * шаблон простая фабрика
 */
class DependentPizzaStore
{
    public function createPizza(string $style, string $type)
    {
        $pizza = null;
        if ($style === "NY") {
            if ($type === "cheese") {
                $pizza = new NYStyleCheesePizza();
            } else if ($type === "veggie") {
                $pizza = new NYStyleVeggiePizza();
            } else if ($type === "clam") {
                $pizza = new NYStyleClamPizza();
            } else if ($type === "pepperoni") {
                $pizza = new NYStylePepperoniPizza();
            }
        } else if ($style === "Chicago") {
            if ($type === "cheese") {
                $pizza = new ChicagoStyleCheesePizza();
            } else if ($type === "veggie") {
                $pizza = new ChicagoStyleVeggiePizza();
            } else if ($type === "clam") {
                $pizza = new ChicagoStyleClamPizza();
            } else if ($type === "pepperoni") {
                $pizza = new ChicagoStylePepperoniPizza();
            } else {
                echo "Error: invalid type of pizza \n";
                return null;
            }
        }

        $pizza->prepare();
        $pizza->bake();
        $pizza->cut();
        $pizza->box();

        return $pizza;
    }
}

/**
 * шаблон фабричный метод (реализует принцип инверсии зависимости)
 */
abstract class PizzaStore
{
    abstract function createPizza(string $item);

	public function orderPizza(string $type)
    {
        $pizza = $this->createPizza($type);
        echo "--- Making a " . $pizza->getName() . " --- \n";

        $pizza->prepare();
        $pizza->bake();
        $pizza->cut();
        $pizza->box();

		return $pizza;
	}
}

/**
 * шаблон простая фабрика
 */
class ChicagoPizzaStore extends PizzaStore
{
    public function createPizza(string $item)
    {
        if ($item === "cheese") {
            return new ChicagoStyleCheesePizza();
        } else if ($item === "veggie") {
            return new ChicagoStyleVeggiePizza();
        } else if ($item === "clam") {
            return new ChicagoStyleClamPizza();
        } else if ($item === "pepperoni") {
            return new ChicagoStylePepperoniPizza();
        } else return null;
    }
}

/**
 * шаблон простая фабрика
 */
class NYPizzaStore extends PizzaStore
{
    public function createPizza(string $item)
    {
        if ($item === "cheese") {
            return new NYStyleCheesePizza();
        } else if ($item === "veggie") {
            return new NYStyleVeggiePizza();
        } else if ($item === "clam") {
            return new NYStyleClamPizza();
        } else if ($item === "pepperoni") {
            return new NYStylePepperoniPizza();
        } else return null;
    }
}

class PizzaTestDrive
{

    public static function main() {
        $nyStore = new NYPizzaStore();
		$chicagoStore = new ChicagoPizzaStore();

		$pizza = $nyStore->orderPizza("cheese");
        echo "Ethan ordered a " . $pizza->getName() . "\n";

		$pizza = $chicagoStore->orderPizza("cheese");
        echo "Joel ordered a " . $pizza->getName() . "\n";

		$pizza = $nyStore->orderPizza("clam");
        echo "Ethan ordered a " . $pizza->getName() . "\n";

		$pizza = $chicagoStore->orderPizza("clam");
        echo "Joel ordered a " . $pizza->getName() . "\n";

		$pizza = $nyStore->orderPizza("pepperoni");
        echo "Ethan ordered a " . $pizza->getName() . "\n";

		$pizza = $chicagoStore->orderPizza("pepperoni");
        echo "Joel ordered a " . $pizza->getName() . "\n";

		$pizza = $nyStore->orderPizza("veggie");
        echo "Ethan ordered a " . $pizza->getName() . "\n";

		$pizza = $chicagoStore->orderPizza("veggie");
        echo "Joel ordered a " . $pizza->getName() . "\n";
	}
}

PizzaTestDrive::main();