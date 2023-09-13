PHP 7 в среднем вдвое быстрее PHP 5.6, а также использует на 50% меньше памяти вовремя обработки запросов

Новвоведения:
- Группировка объявлений импорта (use Framework\Module\{Foo, Bar, Baz};)
- Null-коалесцентный оператор ($bar = $foo ?? 'default';)
- Оператор “космический корабль” <=>
- TypeHints (подсказки по типам данных)
- Исключения движка
- Анонимные классы
- Функции CSPRNG
- Синтаксис Escape-кода для Unicode
- Обновленные генераторы
- Ожидания (expectations)

### Группировка объявлений импорта

До php 7
```php
use Framework\Module\Foo;
use Framework\Module\Bar;
use Framework\Module\Baz;
````

В PHP 7 можно написать:
```php
use Framework\Module\{Foo, Bar, Baz};
```

Или же, если вы предпочитаете многострочный стиль:
```php
use Framework\Module{
Foo,
Bar,
Baz
};
```

### Null-коалесцентный оператор

До php 7
```php
if (isset($foo)) {
    $bar = $foo;
} else {
    $bar = 'default'; // присваиваем $bar значение 'default' если $foo равен NULL
}
````

В PHP 7 можно написать:
```php
$bar = $foo ?? 'default';
```

Можно использовать с цепочкой переменных:
```php
$bar = $foo ?? $baz ?? 'default';
```

### Оператор “космический корабль”

```php
switch ($bar <=> $foo) {
    case 0:
        echo '$bar и $foo равны';
    case -1:
        echo '$foo больше';
    case 1:
        echo '$bar больше';
}
```

Сравниваемые значения могут иметь тип integer, float, string и даже быть массивами. 

### Типы скалярных параметров и подсказки (hints) по возвращаемым типам
```php
class Calculator
{
// объявляем, что параметры имеют целый тип integer
    public function addTwoInts(int $x, int $y): int { 
// явно объявляем, что метод возвращает целое
        return $x + $y;
    }
}
```

### Исключения движка

До PHP 7 такой код привел бы к фатальной ошибке исполнения скрипта:
```php
try {
    thisFunctionDoesNotEvenExist(); //ЭтаФункцияДажеНеСуществует()
} catch (\EngineException $e) {
    // Подчищаем за собой и записываем информацию об ошибке в лог
    echo $e->getMessage();
}
```

### Анонимные классы

До PHP 7:
```php
class MyLogger {
  public function log($msg) {
    print_r($msg . "\n");
  }
}

$pusher->setLogger( new MyLogger() );
```

Использование анонимного класса:
```php
$pusher->setLogger(new class {
  public function log($msg) {
    print_r($msg . "\n");
  }
});
```

Анонимные классы полезны при тестировании юнитами, в частности при мокинге (имитации поведения реального объекта)

### Функции CSPRNG

Две новых функции для генерации крипографически безопасной строки и целых. Первая возвращает случайную строку длиной $len:
```php
random_bytes(int $len);
```
Вторая возвращает число в диапазоне $min… $max.
```php
random_int(int $min, int $max);
```

### Синтаксис Escape-кода для Unicode
До PHP версии 7, в PHP не было способа указать в строке escape-последовательность для Unicode символа.
```php
echo "\u{1F602}"; // выводит смайлик
```

### Обновленные генераторы
...