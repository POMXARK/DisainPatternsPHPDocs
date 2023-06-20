<?php

interface ObserverInterface
{
    public function update(int $value);
}

interface SubjectInterface {
    public function registerObserver(ObserverInterface $observer);
    public function removeObserver(ObserverInterface $observer);
    public function notifyObservers();
}

class SimpleSubject implements SubjectInterface
{
    private $observers = [];
    private $value = 0;

    public function registerObserver(ObserverInterface $observer): void
    {
        $this->observers[] = $observer;
    }

    public function removeObserver(ObserverInterface $observer): void
    {
        foreach ($this->observers as $key => $value) {
            if ($value == $observer) {
                unset($this->observers[$key]);
            }
        }
    }

	public function notifyObservers(): void
    {
        foreach ($this->observers as $observer)
        {
            $observer->update($this->value);
        }
	}

	public function setValue(int $value): void
    {
        $this->value = $value;
        $this->notifyObservers();
    }
}

class SimpleObserver implements ObserverInterface
{
    private $value;

    /** @var SubjectInterface */
	private $simpleSubject;

	public function  __construct(SubjectInterface $simpleSubject)
    {
		$this->simpleSubject = $simpleSubject;
		$this->simpleSubject->registerObserver($this);
	}

    public function update(int $value): void
    {
        $this->value = $value;
        $this-> display();
    }

	public function display(): void
    {
        echo "Value: " . $this->value . "\n";
	}
}

class Example
{
    public static function main(): void
    {
        $simpleSubject = new SimpleSubject();
        $simpleObserver = new SimpleObserver($simpleSubject);

		$simpleSubject->setValue(80);
		$simpleSubject->removeObserver($simpleObserver);
	}
}

Example::main();