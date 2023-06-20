<?php
abstract class AbstractComponent
{
    abstract public function operation();
}

class ConcreteComponent extends AbstractComponent
{
    public function operation()
    {
        // ...
    }
}

abstract class AbstractDecorator extends AbstractComponent
{
    protected $component;

    public function __construct(AbstractComponent $component)
    {
        $this->component = $component;
    }
}

class ConcreteDecorator extends AbstractDecorator
{
    public function operation()
    {
        // ... расширенная функциональность ...
        $this->component->operation();
        // ... расширенная функциональность ...
    }
}

$decoratedComponent = new ConcreteDecorator(
    new ConcreteComponent()
);

$decoratedComponent->operation();