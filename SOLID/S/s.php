<?php

/**
 * Обьект нарушает принцип единственной ответственности
 */
class GodObject
{
    public $id = 1;
    public $name = 'pc';
    public $price = null;

    public function setPrice(float $price): void
    {
        try {
            $this->price = $price;
        } catch (\Exception $e) {
            self::logError($e);
        }
    }

    public static function logError($error): void
    {
        echo 'Возникала ошибка в методе: ' . __METHOD__ . "\n";
    }
}

/**
 * Только сбор и сохранение логов
 */
class Logger
{
    public static function logError($error): void
    {
        echo 'Возникала ошибка в методе: ' . __METHOD__ . "\n";
    }
}

class Model {}

interface ProductInterface {}

/**
 * Эмуляция модели
 */
class Product extends Model implements ProductInterface
{
    public $id = 1;
    public $name = 'pc';
    public $price = null;
}

/**
 * Отвечает только за логику работы с продуктами
 */
class ProductService
{
    /** @var ProductInterface  */
    protected $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }
    public function setPrice(float $price): void
    {
        try {
            $this->price = $price;
        } catch (\Exception $e) {
            Logger::logError($e);
        }

    }
}

// принцип не соблюден
$product = new GodObject();
$product->setPrice(10);

// принцип соблюден
$product = new Product();
$service = new ProductService($product);
$service->setPrice(10);