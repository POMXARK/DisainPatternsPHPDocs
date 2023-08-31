<?php
abstract class Pizza
{
    protected $name;
    protected $dough;
    protected $sauce;
    protected $toppings = [];

    public function getName()
    {
		return $this->name;
	}

	public function prepare()
    {
        echo "Preparing " . $this->name . "\n";
	}

	public function bake()
    {
        echo "Baking " . $this->name . "\n";
	}

	public function cut()
    {
        echo "Cutting " . $this->name . "\n";
	}

	public function box()
    {
        echo "Boxing " . $this->name . "\n";
	}

//	public function toString() {
//    // code to display pizza name and ingredients
//         display = new StringBuffer();
//		display.append("---- " + name + " ----\n");
//		display.append(dough + "\n");
//		display.append(sauce + "\n");
//		for (String topping : toppings) {
//            display.append(topping + "\n");
//        }
//		return display.toString();
//	}
}

class CheesePizza extends Pizza
{
    public function __construct()
    {
		$this->name = "Cheese Pizza";
        $this->dough = "Regular Crust";
        $this->sauce = "Marinara Pizza Sauce";
        $this->toppings[] = "Fresh Mozzarella";
        $this->toppings[] = "Parmesan";
	}
}

class ClamPizza extends Pizza
{
    public function __construct()
    {
        $this->name = "Clam Pizza";
        $this->dough = "Thin crust";
        $this->sauce = "White garlic sauce";
        $this->toppings[] = "Clams";
        $this->toppings[] = "Grated parmesan cheese";
    }
}

class PepperoniPizza extends Pizza
{
    public function __construct()
    {
        $this->name = "Pepperoni Pizza";
        $this->dough = "Crust";
        $this->sauce = "Marinara sauce";
        $this->toppings[] = "Sliced Onion";
        $this->toppings[] = "Grated parmesan cheese";
    }
}

class VeggiePizza extends Pizza
{
    public function __construct()
    {
        $this->name = "Veggie Pizza";
        $this->dough = "Crust";
        $this->sauce = "Marinara sauce";
        $this->toppings[] = "Shredded mozzarella";
        $this->toppings[] = "Grated parmesan";
        $this->toppings[] = "Diced onion";
        $this->toppings[] = "Sliced mushrooms";
        $this->toppings[] = "Sliced red pepper";
        $this->toppings[] = "Sliced black olives";
    }
}

/**
 * шаблон простая фабрика
 */
class SimplePizzaFactory {

    public function createPizza(string $type)
    {
        $pizza = null;

        if ($type === "cheese") {
            $pizza = new CheesePizza();
        } else if ($type === "pepperoni") {
            $pizza = new PepperoniPizza();
        } else if ($type === "clam") {
            $pizza = new ClamPizza();
        } else if ($type === "veggie") {
            $pizza = new VeggiePizza();
        }
        return $pizza;
    }
}

class PizzaStore
{
    protected $factory;

    public function __construct(SimplePizzaFactory $factory)
    {
		$this->factory = $factory;
	}

    public function orderPizza(string $type)
    {
        $pizza = $this->factory->createPizza($type);

        $pizza->prepare();
        $pizza->bake();
        $pizza->cut();
        $pizza->box();

        return $pizza;
	}
}

class PizzaTestDrive {

    public static function main() {
        $factory = new SimplePizzaFactory();
        $store = new PizzaStore($factory);

		$pizza = $store->orderPizza("cheese");
        echo "We ordered a " . $pizza->getName() . "\n";
        print_r($pizza);

        $pizza = $store->orderPizza("veggie");
        echo "We ordered a " . $pizza->getName() . "\n";
        print_r($pizza);
	}
}

PizzaTestDrive::main();