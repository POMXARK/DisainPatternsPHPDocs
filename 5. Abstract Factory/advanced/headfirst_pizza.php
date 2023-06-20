<?php
interface CheeseInterface
{
    public function toString();
}

interface SauceInterface
{
    public function toString();
}

interface VeggiesInterface
{
    public function toString();
}

interface PepperoniInterface
{
    public function toString();
}

interface ClamsInterface
{
    public function toString();
}

interface DoughInterface
{
    public function toString();
}

class BlackOlives implements VeggiesInterface
{
    public function toString()
    {
		return "Black Olives";
	}
}

class Eggplant implements VeggiesInterface
{
    public function toString()
    {
        return "Eggplant";
    }
}

class Garlic implements VeggiesInterface
{
    public function toString()
    {
        return "Garlic";
    }
}

class Mushroom implements VeggiesInterface
{
    public function toString()
    {
        return "Mushrooms";
    }
}

class Onion implements VeggiesInterface
{
    public function toString()
    {
        return "Onion";
    }
}

class RedPepper implements VeggiesInterface
{
    public function toString()
    {
        return "Red Pepper";
    }
}

class Spinach implements VeggiesInterface
{
    public function toString()
    {
		return "Spinach";
	}
}

class ThickCrustDoughInterface implements DoughInterface {
    public function toString()
    {
		return "ThickCrust style extra thick crust DoughInterface";
	}
}

class ThinCrustDoughInterface implements DoughInterface {
    public function toString()
    {
        return "Thin Crust DoughInterface";
    }
}

class FreshClams implements ClamsInterface
{
    public function toString()
    {
        return "Fresh Clams from Long Island Sound";
    }
}

class FrozenClams implements ClamsInterface
{
    public function toString()
    {
        return "Frozen Clams from Chesapeake Bay";
    }
}


class MarinaraSauceInterface implements SauceInterface
{
    public function toString()
    {
        return "Marinara SauceInterface";
    }
}

class PlumTomatoSauceInterface implements SauceInterface
{
    public function toString()
    {
        return "Tomato SauceInterface with plum tomatoes";
    }
}

class MozzarellaCheese implements CheeseInterface
{
    public function toString()
    {
        return "Shredded Mozzarella";
    }
}

class ReggianoCheese implements CheeseInterface
{
    public function toString()
    {
        return "Reggiano Cheese";
    }
}

class ParmesanCheese implements CheeseInterface
{
    public function toString()
    {
        return "Shredded Parmesan";
    }
}

class SlicedPepperoni implements PepperoniInterface
{
    public function toString()
    {
        return "Sliced Pepperoni";
    }
}

abstract class Pizza
{
    protected $name;
    protected $DoughInterface;
    protected $SauceInterface;
    protected $VeggiesInterface = [];
    protected $cheese;
    protected $pepperoni;
    protected $clam;

    abstract function prepare();

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

    public function setName(string $name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
}

interface PizzaIngredientFactory 
{

    public function createDoughInterface();
	public function createSauceInterface();
	public function createCheese();
	public function createVeggiesInterface();
	public function createPepperoni();
	public function createClam();
 
}


class CheesePizza extends Pizza
{
    protected $ingredientFactory;

    public function __construct(PizzaIngredientFactory $ingredientFactory)
    {
		$this->ingredientFactory = $ingredientFactory;
	}

    public function prepare()
    {
        echo "Preparing " . $this->name . "\n";
        $this->DoughInterface = $this->ingredientFactory->createDoughInterface();
        $this->SauceInterface = $this->ingredientFactory->createSauceInterface();
        $this->cheese = $this->ingredientFactory->createCheese();
	}
}

class VeggiePizza extends Pizza
{
    protected $ingredientFactory;

    public function __construct(PizzaIngredientFactory $ingredientFactory)
    {
        $this->ingredientFactory = $ingredientFactory;
    }

    public function prepare()
    {
        echo "Preparing " . $this->name . "\n";
        $this->DoughInterface = $this->ingredientFactory->createDoughInterface();
        $this->SauceInterface = $this->ingredientFactory->createSauceInterface();
        $this->cheese = $this->ingredientFactory->createCheese();
        $this->VeggiesInterface = $this->ingredientFactory->createVeggiesInterface();
    }
}

class PepperoniPizza extends Pizza
{
    protected $ingredientFactory;

    public function __construct(PizzaIngredientFactory $ingredientFactory)
    {
        $this->ingredientFactory = $ingredientFactory;
    }

    public function prepare()
    {
        echo "Preparing " . $this->name . "\n";
        $this->DoughInterface = $this->ingredientFactory->createDoughInterface();
        $this->SauceInterface = $this->ingredientFactory->createSauceInterface();
        $this->cheese = $this->ingredientFactory->createCheese();
        $this->VeggiesInterface = $this->ingredientFactory->createVeggiesInterface();
        $this->pepperoni = $this->ingredientFactory->createPepperoni();
    }
}

class ChicagoPizzaIngredientFactory implements PizzaIngredientFactory
{

    public function createDoughInterface()
    {
		return new ThickCrustDoughInterface();
	}

    public function createSauceInterface()
    {
		return new PlumTomatoSauceInterface();
	}

	public function createCheese()
    {
		return new MozzarellaCheese();
	}

	public function createVeggiesInterface()
    {
        $VeggiesInterface[] = [ new BlackOlives(), new Spinach(), new Eggplant() ];
		return $VeggiesInterface;
	}

	public function createPepperoni()
    {
		return new SlicedPepperoni();
	}

	public function createClam()
    {
		return new FrozenClams();
	}
}

class ClamPizza extends Pizza
{
    protected $ingredientFactory;

    public function __construct(PizzaIngredientFactory $ingredientFactory)
    {
		$this->ingredientFactory = $ingredientFactory;
	}

    public function prepare()
    {
        echo "Preparing " . $this->name . "\n";
        $this->DoughInterface = $this->ingredientFactory->createDoughInterface();
        $this->SauceInterface = $this->ingredientFactory->createSauceInterface();
        $this->cheese = $this->ingredientFactory->createCheese();
        $this->clam = $this->ingredientFactory->createClam();
    }
}

abstract class PizzaStore 
{
    protected abstract function createPizza(string $item);
 
	public function orderPizza(String $type) 
    {
		$pizza = $this->createPizza($type);
        echo "--- Making a " . $pizza->getName() . " ---" . "\n";
        $pizza->prepare();
        $pizza->bake();
        $pizza->cut();
        $pizza->box();
        
		return $pizza;
	}
}

class ChicagoPizzaStore extends PizzaStore
{
    public function createPizza(string $item)
    {
        $pizza = null;
        $ingredientFactory = new ChicagoPizzaIngredientFactory();

        if ($item === "cheese") {
            $pizza = new CheesePizza($ingredientFactory);
            $pizza->setName("Chicago Style Cheese Pizza");
        } else if ($item === "veggie") {

            $pizza = new VeggiePizza($ingredientFactory);
            $pizza->setName("Chicago Style Veggie Pizza");

        } else if ($item === "clam") {

            $pizza = new ClamPizza($ingredientFactory);
            $pizza->setName("Chicago Style Clam Pizza");

        } else if ($item === "pepperoni") {

            $pizza = new PepperoniPizza($ingredientFactory);
            $pizza->setName("Chicago Style Pepperoni Pizza");

        }

        return $pizza;
    }
}

class NYPizzaStore extends PizzaStore
{
    public function createPizza(string $item)
    {
        $pizza = null;
        $ingredientFactory = new NYPizzaIngredientFactory();

        if ($item === "cheese") {
            $pizza = new CheesePizza($ingredientFactory);
            $pizza->setName("New York Style Cheese Pizza");
        } else if ($item === "veggie") {

            $pizza = new VeggiePizza($ingredientFactory);
            $pizza->setName("New York Style Veggie Pizza");

        } else if ($item === "clam") {

            $pizza = new ClamPizza($ingredientFactory);
            $pizza->setName("New York Style Clam Pizza");

        } else if ($item === "pepperoni") {

            $pizza = new PepperoniPizza($ingredientFactory);
            $pizza->setName("New York Style Pepperoni Pizza");

        }

        return $pizza;
    }
}

class NYPizzaIngredientFactory implements PizzaIngredientFactory
{
    public function createDoughInterface()
    {
		return new ThinCrustDoughInterface();
	}

    public function createSauceInterface()
    {
		return new MarinaraSauceInterface();
	}

	public function createCheese()
    {
		return new ReggianoCheese();
	}

	public function createVeggiesInterface()
    {
        $VeggiesInterface[] = [ new Garlic(), new Onion(), new Mushroom(), new RedPepper() ];
		return $VeggiesInterface;
	}

	public function createPepperoni()
    {
		return new SlicedPepperoni();
	}

	public function createClam()
    {
		return new FreshClams();
	}
}

class PizzaTestDrive {

    public static function main() 
    {
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