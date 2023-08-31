<?php

/**
 * Интерфейс Команды объявляет метод для выполнения команд.
 */
interface CommandInterface
{
    public function execute();
}

/**
 * Классы Получателей содержат некую важную бизнес-логику. Они умеют выполнять
 * все виды операций, связанных с выполнением запроса. Фактически, любой класс
 * может выступать Получателем.
 */
class GarageDoor
{

    public function __construct() {}

    public function up()
    {
        echo "Garage Door is Open \n";
	}

    public function down()
    {
        echo "Garage Door is Closed \n";
    }

    public function stop()
    {
        echo "Garage Door is Stopped \n";
    }

    public function lightOn()
    {
        echo "Garage light is on \n";
    }

    public function lightOff()
    {
        echo "Garage light is off \n";
    }
}

/**
 * Но есть и команды, которые делегируют более сложные операции другим объектам,
 * называемым «получателями».
 */
class GarageDoorOpenCommand implements CommandInterface
{
    protected $garageDoor;

    public function __construct(GarageDoor $garageDoor)
    {
		$this->garageDoor = $garageDoor;
	}

    /**
     * Команды могут делегировать выполнение любым методам получателя.
     */
    public function execute()
    {
        $this->garageDoor->up();
	}
}

/**
 * Классы Получателей содержат некую важную бизнес-логику. Они умеют выполнять
 * все виды операций, связанных с выполнением запроса. Фактически, любой класс
 * может выступать Получателем.
 */
class Light
{

    public function __construct() {}

    public function on()
    {
        echo "Light is on \n";
	}

    public function off()
    {
        echo "Light is off \n";
    }
}

/**
 * Но есть и команды, которые делегируют более сложные операции другим объектам,
 * называемым «получателями».
 */
class LightOffCommand implements CommandInterface
{
    protected $light;

    public function __construct(Light $light) {
        $this->light = $light;
    }

    /**
     * Команды могут делегировать выполнение любым методам получателя.
     */
    public function execute()
    {
        $this->light->off();
    }
}

/**
* Но есть и команды, которые делегируют более сложные операции другим объектам,
 * называемым «получателями».
 */
class LightOnCommand implements CommandInterface
{
    protected $light;

    public function __construct(Light $light) {
        $this->light = $light;
    }

    /**
     * Команды могут делегировать выполнение любым методам получателя.
     */
    public function execute()
    {
        $this->light->on();
    }
}

/**
 * Отправитель связан с одной или несколькими командами. Он отправляет запрос
 * команде.
 */
class SimpleRemoteControl
{
    protected $slot;

    public function __construct() {}

    public function setCommand(CommandInterface $command)
    {
        $this->slot = $command;
    }

    /**
     * Отправитель не зависит от классов конкретных команд и получателей.
     * Отправитель передаёт запрос получателю косвенно, выполняя команду.
     */
	public function buttonWasPressed()
    {
        $this->slot->execute();
	}
}

/**
 * Клиентский код может параметризовать отправителя любыми командами.
 */
class RemoteControlTest
{
    public static function main()
    {
        $remote = new SimpleRemoteControl();
		$light = new Light();
		$garageDoor = new GarageDoor();
		$lightOn = new LightOnCommand($light);
		$garageOpen = new GarageDoorOpenCommand($garageDoor);

		$remote->setCommand($lightOn);
		$remote->buttonWasPressed();
		$remote->setCommand($garageOpen);
		$remote->buttonWasPressed();
    }
}

RemoteControlTest::main();