<?php

/**
 * Абстрактное поведение при полете
 */
interface FlyBehaviorInterface
{
    public function fly();
}

class FlyNoWay implements FlyBehaviorInterface
{
    public function fly(): void
    {
        echo "I can't fly \n";
	}
}

class FlyRocketPowered implements FlyBehaviorInterface
{
    public function fly(): void
    {
        echo "I'm flying with a rocket \n";
    }
}

class FlyWithWings implements FlyBehaviorInterface
{
    public function fly(): void
    {
        echo "I'm flying!! \n";
    }
}

/**
 * Абстрактное поведение при кряканье
 */
interface QuackBehaviorInterface
{
    public function quack();
}

class FakeQuack implements QuackBehaviorInterface
{
    public function quack()
    {
        echo "Qwak \n";
	}
}

class MuteQuack implements QuackBehaviorInterface
{
    public function quack()
    {
        echo "<< Silence >> \n";
    }
}

class Quack implements QuackBehaviorInterface
{
    public function quack()
    {
        echo "Quack \n";
    }
}

class Squeak implements QuackBehaviorInterface
{
    public function quack()
    {
        echo "Squeak \n";
    }
}

/**
 * Абстрактная утка, агрегирует полет и кряканье
 */
abstract class Duck
{
    /** @var FlyBehaviorInterface */
    protected $flyBehavior;

    /** @var QuackBehaviorInterface */
    protected $quackBehavior;

    public function __construct()
    {

	}

    public function setFlyBehavior(FlyBehaviorInterface $fb): void
    {
        $this->flyBehavior = $fb;
    }

	public function setQuackBehavior(QuackBehaviorInterface $qb): void
    {
        $this->quackBehavior = $qb;
    }

	abstract function display();

	public function performFly(): void
    {
        $this->flyBehavior->fly();
	}

	public function performQuack(): void
    {
        $this->quackBehavior->quack();
	}

	public function swim(): void
    {
        echo "All ducks float, even decoys! \n";
	}
}

class DecoyDuck extends Duck
{
    public function __construct()
    {
		$this->setFlyBehavior(new FlyNoWay());
        $this->setQuackBehavior(new MuteQuack());
	}

    public function display()
    {
        echo "I'm a duck Decoy \n";
    }
}

class MallardDuck extends Duck
{
    public function __construct()
    {
        $this->setQuackBehavior(new Quack());
        $this->setFlyBehavior(new FlyWithWings());
    }

    public function display()
    {
        echo "I'm a real Mallard duck \n";
    }
}

class ModelDuck extends Duck
{
    public function __construct()
    {
        $this->setFlyBehavior(new FlyNoWay());
        $this->setQuackBehavior(new Quack());
    }

    public function display()
    {
        echo "I'm a model duck \n";
    }
}

class RedHeadDuck extends Duck
{
    /**
     * Не контролируемое присвоение реализации,
     * нет возсожности задать дополнительную логику
     * при инициализации полета и кряканья
     */
    public function __construct()
    {
        $this->flyBehavior = new FlyWithWings();
        $this->quackBehavior = new Quack();
    }

    public function display(): void
    {
        echo "I'm a real Red Headed duck \n";
    }
}


/**
 * Бизнес логика
 */
class MiniDuckSimulator
{
    public static function main(): void
    {
		$mallard = new MallardDuck();
		$mallard->performQuack();
		$mallard->performFly();

        $model = new ModelDuck();
		$model->performFly();
		$model->setFlyBehavior(new FlyRocketPowered());
		$model->performFly();

        $decoy = new DecoyDuck();
        $decoy->performQuack();
	}
}

MiniDuckSimulator::main();