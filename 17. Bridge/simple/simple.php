<?php

interface ImplementorInterface
{
    public function operationImp();
}

/**
 * определяет базовый интерфейс и хранит ссылку на объект Implementor.
 * Выполнение операций в Abstraction делегируется методам объекта Implementor
 */
abstract class Abstraction
{
    /** @var  ImplementorInterface */
    private $implementor;

    public function setImplementor(ImplementorInterface $imp)
    {
        $this->implementor = $imp;
    }

    public function __construct(ImplementorInterface $imp)
    {
        $this->implementor = $imp;
    }

    public function operation()
    {
        $this->implementor->operationImp();
    }
}

/**
 *  уточненная абстракция, наследуется от Abstraction и расширяет унаследованный интерфейс
 */
class RefinedAbstraction extends Abstraction
{
    public function __construct(ImplementorInterface $imp)
    {
        parent::__construct($imp);
    }

    public function operation()
    {
    }
}

/**
 * конкретные реализации, которые унаследованы от Implementor
 */
class ConcreteImplementorA implements ImplementorInterface
{
    public function operationImp()
    {
        // TODO: Implement operationImp() method.
    }
}

/**
 * конкретные реализации, которые унаследованы от Implementor
 */
class ConcreteImplementorB implements ImplementorInterface
{
    public function operationImp()
    {
        // TODO: Implement operationImp() method.
    }
}

$abstraction = new RefinedAbstraction(new ConcreteImplementorA());
$abstraction->operation();

$abstraction->setImplementor(new ConcreteImplementorB());
$abstraction->operation();