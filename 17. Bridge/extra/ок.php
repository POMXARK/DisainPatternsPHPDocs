<?php
/**
 * При таком исполнении для добавления сущности Client потребуется создать только ClientWidgetRealization,
 * А при добавлении нового типа виджета class WidgetOtherAbstraction extends WidgetAbstract,
 * и будет возможность включить их в общую цепочку запуска,
 * при этом создовать тип виджита, и реализацию виджета можно менять независимо друг от друга,
 * в абстракцию обычно передается реализация по интерфейсу,
 * а в реализацию может передоваться связанная сущность
 */

interface WidgetRealizationInterface
{
    public function getId();
    public function getTitle();
    public function getDescription();
}

class ProductWidgetRealization implements WidgetRealizationInterface
{
    private $entity;

    public function __construct(Product $product)
    {
        $this->entity = $product;
    }

    public function getId()
    {
        return $this->entity->id;
    }

    public function getTitle()
    {
        return $this->entity->name;
    }

    public function getDescription()
    {
        return $this->entity->description;
    }
}

class CategoryWidgetRealization implements WidgetRealizationInterface
{
    private $entity;

    public function __construct(Category $category)
    {
        $this->entity = $category;
    }

    public function getId()
    {
        return $this->entity->id;
    }

    public function getTitle()
    {
        return $this->entity->title;
    }

    public function getDescription()
    {
        return $this->entity->description;
    }
}

class WidgetAbstract {
    protected $realization;

    public function setRealization(WidgetRealizationInterface $realization)
    {
        $this->realization = $realization;
    }

    public function getRealization()
    {
        return $this->realization;
    }

    protected function viewLogic($viewData): void
    {
        $method = class_basename(static::class) . '::' . __FUNCTION__;
        echo $method . ' ' . $viewData . "\n";
    }
}

class WidgetBigAbstraction extends WidgetAbstract
{
    public function run(WidgetRealizationInterface $realization): void
    {
        $this->setRealization($realization);

        $viewData = $this->getViewData();
        $this->viewLogic($viewData);
    }

    private function getViewData(): array
    {
        $id = $this->getRealization()->getId();
        $fillTitle  = $this->getFullTitle();
        $description = $this->getRealization()->getDescription();

        return compact('id', 'fillTitle', 'description');
    }

    private function getFullTitle(): string
    {
        return $this->getRealization()->getId()
            . '::::'
            . $this->getRealization()->getTitle();

    }
}

class WidgetMiddleAbstraction extends WidgetAbstract
{
    public function run(WidgetRealizationInterface $realization): void
    {
        $this->setRealization($realization);

        $viewData = $this->getViewData();
        $this->viewLogic($viewData);
    }

    private function getViewData(): array
    {
        $id = $this->getRealization()->getId();
        $middleTitle  = $this->getMiddleTitle();
        $description = $this->getRealization()->getDescription();

        return compact('id', 'middleTitle', 'description');
    }

    private function getMiddleTitle(): string
    {
        return $this->getRealization()->getId()
            . '->'
            . $this->getRealization()->getTitle();

    }
}

class WidgetSmallAbstraction extends WidgetAbstract
{
    public function run(WidgetRealizationInterface $realization): void
    {
        $this->setRealization($realization);

        $viewData = $this->getViewData();
        $this->viewLogic($viewData);
    }

    private function getViewData(): array
    {
        $id = $this->getRealization()->getId();
        $smallTitle  = $this->getSmallTitle();

        return compact('id', 'smallTitle');
    }

    private function getSmallTitle(): string
    {
        return $this->getRealization()->getId()
            . '...'
            . $this->getRealization()->getTitle();

    }
}

class BridgeDemo
{
    public function run()
    {
        $productRealization = new ProductWidgetRealization(new Product());
        $categoryRealization = new CategoryWidgetRealization(new Category());

        $views = [
            new WidgetBigAbstraction(),
            new WidgetMiddleAbstraction(),
            new WidgetSmallAbstraction()
        ];

        foreach ($views as $view) {
            $view->run($productRealization);
            $view->run($categoryRealization);
        }

    }
}