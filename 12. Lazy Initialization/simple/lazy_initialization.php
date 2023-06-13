<?php

/**
 * Mock вызова из бд
 */
class User {

    public int $id = 1;
    public string $login = 'admin';

    public static function first(): User
    {
        return new User();
    }
}

class LazyInitialization
{
    private $user = null;

    public function __construct()
    {

    }

    /**
     * Не происходит повторного выполнения операции (Singleton метод)
     *
     * @return User|array
     */
    public function getUser(): User|array
    {
        if(is_null($this->user))
        {
            echo "Обращение к бд ... \n";
            sleep(2); // эмуляция долгого ответа, тяжелой операции
            $this->user = User::first(); // ресурсоемкая долгая операция
        }

        return $this->user;
    }
}

$lazyLoad = new LazyInitialization();
print_r($lazyLoad->getUser()->id);
echo "\n";
print_r($lazyLoad->getUser()->login);