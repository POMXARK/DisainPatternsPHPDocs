<?php
/**
 * Существует множество программистов,
 * но одни являются фрилансерами,
 * кто-то работает в компании инженером,
 * кто-то совмещает работу в компании и фриланс.
 *
 * Таким образом, вырисовывается иерархия различных классов программистов.
 * Но эти программисты могут работать с различными языками и технологиями.
 * И в зависимости от выбранного языка деятельность программиста будет отличаться.
 */
interface Task {}

/**
 * Сборщик программы нечего не знает о рабочем режиме програмиста
 */
interface LanguageInterface
{
    public function build();

    public function execute();
}

/**
 * Сборщик программы нечего не знает о рабочем режиме програмиста
 */
class CPPLanguage implements LanguageInterface
{
    public function build(): void
    {
        echo "С помощью компилятора C++ компилируем программу в бинарный код \n";
    }

    public function execute(): void
    {
        echo "Запускаем исполняемый файл программы \n";
    }
}

/**
 * Сборщик программы нечего не знает о рабочем режиме програмиста
 */
class CSharpLanguage implements  LanguageInterface
{
    public function build(): void
    {
        echo "С помощью компилятора Roslyn компилируем исходный код в файл exe \n";
    }

    public function execute(): void
    {
        echo "JIT компилирует программу бинарный код \n";
        echo "CLR выполняет скомпилированный бинарный код \n";
    }
}

/**
 * Абстрактный програмист нечего не знает о испольуемом языке
 * Содержит реализацию метода работать,
 * и обязательно наследник должен содержать реализацию метода оплаты труда
 * метод работать использует внешний интерфейс языка
 */
abstract class Programmer
{
    /** @var LanguageInterface */
    protected $language;

    public function setLanguage(LanguageInterface $lang): void
    {
        $this->language = $lang;
    }

    public function __construct(LanguageInterface $lang)
    {
        $this->language = $lang;
    }

    public function DoWork(): void
    {
        $this->language->build();
        $this->language->execute();
    }

    abstract public function earnMoney();
}

/**
 * Обработчик рабочего времени нечего не знает о используемом языке
 * реализует метод оплаты
 */
class FreelanceProgrammer extends Programmer
{
    public function earnMoney(): void
    {
        echo "Получаем оплату за выполненный заказ \n";
    }
}

/**
 * Обработчик рабочего времени нечего не знает о используемом языке
 * реализует метод оплаты
 */
class CorporateProgrammer extends Programmer
{
    public function earnMoney(): void
    {
        echo "Получаем в конце месяца зарплату \n";
    }
}

// создаем нового программиста, он работает с с++
$freelancer = new FreelanceProgrammer(new CPPLanguage());
$freelancer->DoWork();
$freelancer->earnMoney();

// пришел новый заказ, но теперь нужен c#
$freelancer->setLanguage(new CSharpLanguage());
$freelancer->DoWork();
$freelancer->earnMoney();

/**
 *
 * В роли Abstraction выступает класс Programmer,
 * а в роли Implementor - интерфейс LanguageInterface, который представляет язык программирования.
 *
 * В методе DoWork() класса Programmer вызываются методы объекта LanguageInterface.
 * Языки CPPLanguage и CSharpLanguage определяют конкретные реализации,
 * а классы FreelanceProgrammer и CorporateProgrammer представляют уточненные абстракции.
 *
 * Таким образом, благодаря применению паттерна реализация отделяется от абстракции.
 * Мы можем развивать независимо две параллельные иерархии.
 * Устраняются зависимости между реализацией и абстракцией во время компиляции,
 * и мы можем менять конкретную реализацию во время выполнения.
 */
interface Conclusion {}