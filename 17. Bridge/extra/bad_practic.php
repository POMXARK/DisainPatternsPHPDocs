<?php

/**
 * #### Задача

    Сервис "яндекс музыка"

    - трек (маленький виджет)
    - категория треков (средний виджет)
    - сборник категорий (большой виджет)
 *
 * Проблема данной реализации,
 * если придется сделать новый виджет и для продукта и для категории
 *
 * для новой сущности клиент необходимо сделать все типы виджетов
 */

/**
 * Экземпляр класса модели
 */
abstract class Model {}

class Product extends Model
{
    public $id = 1;
    public $name = 'ProductName';
    public $description = 'ProductDescription';
}

class Category extends Model
{
    public $id = 100;
    public $title = 'CategoryTitle';
    public $description = 'CategoryDescription';
}

class Client extends Model
{
    public $id = 100;
    public $name = 'ClientName';
    public $bio = 'ClientBio';
}

class WidgetAbstract
{
    protected function viewLogic($viewData): void
    {
        $method = class_basename(static::class) . '::' . __FUNCTION__;
        echo $method . ' ' . $viewData . "\n";
    }
}

class WidgetBigProduct extends WidgetAbstract
{
    public function run(Product $product): void
    {
        $viewData = $this->getRealizationLogic($product);

        $this->viewLogic($viewData);
    }

    private function getRealizationLogic(Product $product): array
    {
        $id = $product->id;
        $fullTitle = $product->id . '::::' . $product->name;
        $description = $product->description;

        return compact('id','fullTitle','description');
    }
}

class WidgetMiddleProduct extends WidgetAbstract
{
    public function run(Product $product): void
    {
        $viewData = $this->getRealizationLogic($product);

        $this->viewLogic($viewData);
    }

    private function getRealizationLogic(Product $product): array
    {
        $id = $product->id;
        $middleTitle = $product->id . '->' . $product->name;
        $description = $product->description;

        return compact('id','middleTitle','description');
    }
}

class WidgetSmallProduct extends WidgetAbstract
{
    public function run(Product $product): void
    {
        $viewData = $this->getRealizationLogic($product);

        $this->viewLogic($viewData);
    }

    private function getRealizationLogic(Product $product): array
    {
        $id = $product->id;
        $smallTitle = $product->name;
        $description = $product->description;

        return compact('id','smallTitle','description');
    }
}

class WidgetBigCategory extends WidgetAbstract
{
    public function run(Category $category): void
    {
        $viewData = $this->getRealizationLogic($category);

        $this->viewLogic($viewData);
    }

    private function getRealizationLogic(Category $category): array
    {
        $id = $category->id;
        $fullTitle = $category->id . '::::' . $category->title;
        $description = $category->description;

        return compact('id','fullTitle','description');
    }
}

class WidgetMiddleCategory extends WidgetAbstract
{
    public function run(Category $category): void
    {
        $viewData = $this->getRealizationLogic($category);

        $this->viewLogic($viewData);
    }

    private function getRealizationLogic(Category $category): array
    {
        $id = $category->id;
        $middleTitle = $category->id . '->' . $category->title;
        $description = $category->description;

        return compact('id','middleTitle','description');
    }
}

class WidgetSmallCategory extends WidgetAbstract
{
    public function run(Category $category): void
    {
        $viewData = $this->getRealizationLogic($category);

        $this->viewLogic($viewData);
    }

    private function getRealizationLogic(Category $category): array
    {
        $id = $category->id;
        $smallTitle = $category->title;
        $description = $category->description;

        return compact('id','smallTitle','description');
    }
}


class WithoutBridgeDemo
{
    public function run()
    {
        $product = new Product();
        (new WidgetBigProduct())->run($product);
        (new WidgetMiddleProduct())->run($product);
        (new WidgetSmallProduct())->run($product);

        $category = new Category();
        (new WidgetBigCategory())->run($category);
        (new WidgetMiddleCategory())->run($category);
        (new WidgetSmallCategory())->run($category);
    }
}