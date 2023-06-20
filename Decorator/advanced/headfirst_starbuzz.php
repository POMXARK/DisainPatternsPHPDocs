<?php
abstract class Beverage
{
    protected $description = "Unknown Beverage";

    public function getDescription()
    {
		return $this->description;
	}

    public abstract function cost();
}

abstract class CondimentDecorator extends Beverage
{
    protected $beverage;
}

class DarkRoast extends Beverage
{
    public function __construct()
    {
		$this->description = "Dark Roast Coffee";
	}

    public function cost()
    {
		return .99;
	}
}

class Decaf extends Beverage
{
    public function __construct()
    {
        $this->description = "Decaf Coffee";
    }

    public function cost()
    {
        return 1.05;
    }
}

class Espresso extends Beverage
{
    public function __construct()
    {
        $this->description = "Espresso";
    }

    public function cost()
    {
        return 1.99;
    }
}

class HouseBlend extends Beverage
{
    public function __construct()
    {
        $this->description = "House Blend Coffee";
    }

    public function cost()
    {
        return .89;
    }
}

class Milk extends CondimentDecorator
{
    public function __construct(Beverage $beverage)
    {
		$this->beverage = $beverage;
	}

    public function getDescription()
    {
		return $this->beverage->getDescription() . ", Milk";
	}

	public function cost()
    {
		return .10 . $this->beverage->cost();
	}
}

class Mocha extends CondimentDecorator
{
    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    public function getDescription()
    {
        return $this->beverage->getDescription() . ", Mocha";
    }

    public function cost()
    {
        return .20 . $this->beverage->cost();
    }
}

class Soy extends CondimentDecorator
{
    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    public function getDescription()
    {
        return $this->beverage->getDescription() . ", Soy";
    }

    public function cost()
    {
        return .15 . $this->beverage->cost();
    }
}

class Whip extends CondimentDecorator
{
    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    public function getDescription()
    {
        return $this->beverage->getDescription() . ", Whip";
    }

    public function cost()
    {
        return .10 . $this->beverage->cost();
    }
}

class StarbuzzCoffee {

    public static function main() {
        $beverage = new Espresso();
        echo $beverage->getDescription() . " $" . $beverage->cost() . "\n";

        $beverage2 = new DarkRoast();
		$beverage2 = new Mocha($beverage2);
		$beverage2 = new Mocha($beverage2);
		$beverage2 = new Whip($beverage2);
        echo $beverage2->getDescription() . " $" . $beverage2->cost() . "\n";

        $beverage3 = new HouseBlend();
		$beverage3 = new Soy($beverage3);
		$beverage3 = new Mocha($beverage3);
		$beverage3 = new Whip($beverage3);
        echo $beverage3->getDescription() . " $" . $beverage3->cost() . "\n";
	}
}

StarbuzzCoffee::main();