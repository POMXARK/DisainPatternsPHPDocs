<?php

interface OrderInterface
{
    public function orderUp(); // execute()
}

class Cook {

    public function __construct() {}

    public function makeBurger() {
        echo "Making a burger \n";
	}

	public function makeFries() {
        echo "Making fries \n";
	}
}

class BurgerAndFriesOrder implements OrderInterface
{
    protected $cook;

    public function __construct(Cook $cook)
    {
		$this->cook = $cook;
	}

    public function orderUp()
    {
        $this->cook->makeBurger();
        $this->cook->makeFries();
	}
}

class Waitress {
    protected  $order;
    public function __construct() {}

    public function takeOrder(OrderInterface $order)
    {
        $this->order = $order;
        $this->order->orderUp();
    }
}

class Customer
{
    protected $waitress;
    protected $order;

    public function __construct(Waitress $waitress)
    {
		$this->waitress = $waitress;
	}

    public function createOrder(OrderInterface $order)
    {
        $this->order = $order;
    }

	public function hungry()
    {
        $this->waitress->takeOrder($this->order);
	}
}

class Diner
{
    public static function main()
    {
        $cook = new Cook();
		$waitress = new Waitress();
		$customer = new Customer($waitress);
        $customer->createOrder(new BurgerAndFriesOrder($cook));
        $customer->hungry();
	}
}

Diner::main();