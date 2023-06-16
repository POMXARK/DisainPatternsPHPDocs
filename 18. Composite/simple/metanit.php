<?php

/**
 * определяет интерфейс для всех компонентов в древовидной структуре
 */
abstract class Component
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public abstract function add(Component $component);
    public abstract function remove(Component $component);

    public abstract function display();
}

/**
 * представляет компонент, который может содержать другие компоненты
 * и реализует механизм для их добавления и удаления
 */
class Composite extends Component
{
    protected $components = [];

    public function display(): void
    {
        echo $this->name . " display (Composite) \n";

        //print_r($this->components);

        // проходимся по дочерним компонентам
        foreach ($this->components as $component)
        {
            $component->display();
        }
    }

    public function add(Component $component)
    {
        $this->components[] = $component;
    }

    public function remove(Component $component)
    {
        foreach ($this->components as $key => $value){
            if ($value == $component) {
                unset($this->components[$key]);
            }
        }
    }
}

/**
 * представляет отдельный компонент,
 * который не может содержать другие компоненты
 */
class Leaf extends Component
{
    public function display()
    {
        echo $this->name . " display (Leaf) \n";
    }

    /**
     * @throws Exception
     */
    public function add(Component $component)
    {
        throw new Exception('Запрещено добавлять в дочерний обьект');
    }

    /**
     * @throws Exception
     */
    public function remove(Component $component)
    {
        throw new Exception('Запрещено удалять из в дочернего обьекта');
    }
}

/**
 * клиент, который использует компоненты
 */
class Client
{
    /**
     * 1. Создаем состовляющие обьекты иерархии
     * 2. связываем их в иерархию
     * 3. запускаем общий для всех метод
     *
     * @return void
     */
    public function main()
    {
        // Создаем состовляющие обьекты иерархии
        $root = new Composite("Root");
        $leaf = new Leaf("Leaf");

        // Создаем состовляющие обьекты иерархии
        $subtree = new Composite("Subtree");

        // связываем их в иерархию
        $root->add($leaf);
        $root->add($subtree);

        // запускаем общий для всех метод
        $root->display();

        // нарушение использования
        $leaf->add($subtree);
    }
}

(new Client())->main();