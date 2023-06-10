<?php

// Объявим интерфейс PropertyContainerInterface

interface PropertyContainerInterface
{
    function setProperty($propertyName, $value);

    function updateTitle($propertyName, $value);

    function getProperty($propertyName);

    function deleteProperty($propertyName);
}

// Напишем реализацию интерфейса.

class PropertyContainer implements PropertyContainerInterface
{
    private $propertyContainer = [];

    function setProperty($propertyName, $value)
    {
        $this->propertyContainer[$propertyName] = $value;
    }

    function updateTitle($propertyName, $value)
    {
        if (!isset($this->propertyContainer[$propertyName])) {
            throw new Exception("property {$propertyName} not found");
        }

        $this->propertyContainer[$propertyName] = $value;
    }

    function getProperty($propertyName)
    {
        return $this->propertyContainer[$propertyName];
    }

    function deleteProperty($propertyName)
    {
        unset($this->propertyContainer[$propertyName]);
    }

}

// Унаследуем реализованный класс контейнер с методами.

class BlogPost extends PropertyContainer
{
    private $title;

    public function setTitle($title)
    {
        $this->title = $title;
    }
}

// Пример использования контейнера свойств.

$post = new BlogPost();

// присваиваем свойство изначально объявленное в классе
$post->setTitle('Hello');

// присваиваем динамическое свойство объекту
$post->setProperty('view_count', 100);
$post->updateTitle('view_count', 200);

print_r('view_count: ' . $post->getProperty('view_count'));
echo "\n\n";

print_r($post);
echo "\n\n";

$post->deleteProperty('view_count');
print_r($post);