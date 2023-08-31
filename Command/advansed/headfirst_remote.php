<?php
class CeilingFan
{
    const HIGH = 3;
    const MEDIUM = 2;
    const LOW = 1;
    const OFF = 0;
    protected $location;
    protected $speed;

    public function __construct(string $location)
    {
        $this->location = $location;
    }

    public function high()
    {
        // turns the ceiling fan on to high
        $this->speed = self::HIGH;
        echo $this->location . " ceiling fan is on high \n";
    }

    public function medium()
    {
        // turns the ceiling fan on to medium
        $this->speed = self::MEDIUM;
        echo $this->location . " ceiling fan is on medium \n";
    }

    public function low()
    {
        // turns the ceiling fan on to low
        $this->speed = self::LOW;
        echo $this->location . " ceiling fan is on low \n";
    }

    public function off()
    {
        // turns the ceiling fan on to off
        $this->speed = self::OFF;
        echo $this->location . " ceiling fan is on off \n";
    }

    public function getSpeed()
    {
        return $this->speed;
    }
}

interface CommandInterface {
    public function execute();
}

class CeilingFanOffCommand implements CommandInterface
{
    protected $ceilingFan;

    public function __construct(CeilingFan $ceilingFan)
    {
        $this->ceilingFan = $ceilingFan;
    }

    public function execute()
    {
        $this->ceilingFan->off();
    }
}

class CeilingFanOnCommand implements CommandInterface
{
    protected $ceilingFan;

    public function __construct(CeilingFan $ceilingFan)
    {
        $this->ceilingFan = $ceilingFan;
    }

    public function execute()
    {
        $this->ceilingFan->high();
    }
}

class GarageDoor {
    protected $location;

    public function __construct(string $location)
    {
		$this->location = $location;
	}

    public function up()
    {
        echo $this->location . " garage Door is Up \n";
	}

    public function down()
    {
        echo $this->location . " garage Door is Down \n";
    }

    public function stop()
    {
        echo $this->location . " garage Door is Stopped \n";
    }

    public function lightOn()
    {
        echo $this->location . " garage light is on \n";
    }

    public function lightOff()
    {
        echo $this->location . " garage light is off \n";
    }
}

class GarageDoorDownCommand implements CommandInterface
{
    protected $garageDoor;

    public function __construct(GarageDoor $garageDoor)
    {
		$this->garageDoor = $garageDoor;
	}

    public function execute()
    {
        $this->garageDoor->down();
	}
}

class GarageDoorUpCommand implements CommandInterface
{
    protected $garageDoor;

    public function __construct(GarageDoor $garageDoor)
    {
        $this->garageDoor = $garageDoor;
    }

    public function execute()
    {
        $this->garageDoor->up();
    }
}

class Hottub
{
    protected $on;
    protected $temperature;

    public function __construct() {
	}

    public function on()
    {
        $this->on = true;
	}

    public function off()
    {
        $this->on = false;
    }


	public function bubblesOn()
    {
		if ($this->on) {
            echo "Hottub is bubbling! \n";
        }
	}

    public function bubblesOff()
    {
        if ($this->on) {
            echo "Hottub is not bubbling! \n";
        }
    }

    public function jetsOn()
    {
        if ($this->on) {
            echo "Hottub jets are on \n";
        }
    }

    public function jetsOff()
    {
        if ($this->on) {
            echo "Hottub jets are off \n";
        }
    }


	public function setTemperature(int $temperature)
    {
        $this->temperature = $temperature;
    }

	public function heat()
    {
        $this->temperature = 105;
		echo "Hottub is heating to a steaming 105 degrees \n";
	}

	public function cool()
    {
        $this->temperature = 98;
        echo "Hottub is cooling to 98 degrees \n";
	}

}

class HottubOffCommand implements CommandInterface
{
    protected $hottub;

    public function __construct(Hottub $hottub)
    {
		$this->hottub = $hottub;
	}

    public function execute()
    {
        $this->hottub->cool();
        $this->hottub->off();
	}
}

class HottubOnCommand implements CommandInterface
{
    protected $hottub;

    public function __construct(Hottub $hottub)
    {
        $this->hottub = $hottub;
    }

    public function execute()
    {
        $this->hottub->cool();
        $this->hottub->heat();
        $this->hottub->bubblesOn();
    }
}

class Light {
    protected $location = "";

    public function __construct(string $location)
    {
        $this->location = $location;
	}

    public function on()
    {
        echo $this->location . " light is on \n";
	}

    public function off()
    {
        echo $this->location . " light is off \n";
    }
}

class LightOffCommand implements CommandInterface
{
    protected $light;

    public function __construct(Light $light) {
		$this->light = $light;
	}

    public function execute()
    {
        $this->light->off();
	}
}

class LightOnCommand implements CommandInterface
{
    protected $light;

    public function __construct(Light $light) {
        $this->light = $light;
    }

    public function execute()
    {
        $this->light->on();
    }
}

class LivingroomLightOffCommand implements CommandInterface
{
    protected $light;

    public function __construct(Light $light) {
        $this->light = $light;
    }

    public function execute()
    {
        $this->light->off();
    }
}

class LivingroomLightOnCommand implements CommandInterface
{
    protected $light;

    public function __construct(Light $light) {
        $this->light = $light;
    }

    public function execute()
    {
        $this->light->on();
    }
}

class NoCommand implements CommandInterface
{
    public function execute() { }
}

class RemoteControl
{
    protected $onCommands = [];
    protected $offCommands = [];

    public function __construct() {}

    public function setCommand(int $slot, CommandInterface $onCommand, CommandInterface $offCommand)
    {
        $this->onCommands[$slot] = $onCommand;
        $this->offCommands[$slot] = $offCommand;
    }

	public function onButtonWasPushed(int $slot)
    {
        $this->onCommands[$slot]->execute();
    }

    public function offButtonWasPushed(int $slot)
    {
        $this->offCommands[$slot]->execute();
    }
}

class Stereo
{
    protected $location;

    public function  __construct(string $location)
    {
		$this->location = $location;
	}

    public function on()
    {
        echo $this->location . " stereo is on \n";
	}

    public function off()
    {
        echo $this->location . " stereo is off \n";
    }

    public function setCD()
    {
        echo $this->location . " stereo is set for CD input \n";
    }

    public function setDVD()
    {
        echo $this->location . " stereo is set for DVD input \n";
    }

    public function setRadio()
    {
        echo $this->location . " stereo is set for Radio \n";
    }

    public function setVolume(int $volume)
    {
        // code to set the volume
        // valid range: 1-11 (after all 11 is better than 10, right?)
        echo $this->location . " Stereo volume set to " . $volume . " \n";
    }
}

class StereoOffCommand implements CommandInterface
{
    protected $stereo;

    public function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    public function execute()
    {
        $this->stereo->off();
    }
}

class StereoOnWithCDCommand implements CommandInterface
{
    protected $stereo;

    public function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    public function execute()
    {
        $this->stereo->on();
        $this->stereo->setCD();
        $this->stereo->setVolume(11);
    }
}

class TV
{
    protected $location;
    protected $channel;

    public function __construct(string $location)
    {
        $this->location = $location;
    }

    public function on() {
        echo " TV is on \n";
    }

    public function off() {
        echo  " TV is off \n";
    }


    public function setInputChannel() {
        $this->channel = 3;
        echo " Channel is set for VCR \n";
    }
}

class RemoteLoader
{
    public static function main()
    {
        $remoteControl = new RemoteControl();

		$livingRoomLight = new Light("Living Room");
		$kitchenLight = new Light("Kitchen");
		$ceilingFan= new CeilingFan("Living Room");
		$garageDoor = new GarageDoor("Garage");
		$stereo = new Stereo("Living Room");

		$livingRoomLightOn = new LightOnCommand($livingRoomLight);
		$livingRoomLightOff = new LightOffCommand($livingRoomLight);
		$kitchenLightOn = new LightOnCommand($kitchenLight);
		$kitchenLightOff = new LightOffCommand($kitchenLight);

		$ceilingFanOn = new CeilingFanOnCommand($ceilingFan);
		$ceilingFanOff = new CeilingFanOffCommand($ceilingFan);

		$garageDoorUp = new GarageDoorUpCommand($garageDoor);
		$garageDoorDown = new GarageDoorDownCommand($garageDoor);

		$stereoOnWithCD = new StereoOnWithCDCommand($stereo);
		$stereoOff = new StereoOffCommand($stereo);

		$remoteControl->setCommand(0, $livingRoomLightOn, $livingRoomLightOff);
		$remoteControl->setCommand(1, $kitchenLightOn, $kitchenLightOff);
		$remoteControl->setCommand(2, $ceilingFanOn, $ceilingFanOff);
		$remoteControl->setCommand(3, $stereoOnWithCD, $stereoOff);

        print_r($remoteControl);

		$remoteControl->onButtonWasPushed(0);
		$remoteControl->offButtonWasPushed(0);
		$remoteControl->onButtonWasPushed(1);
		$remoteControl->offButtonWasPushed(1);
		$remoteControl->onButtonWasPushed(2);
		$remoteControl->offButtonWasPushed(2);
		$remoteControl->onButtonWasPushed(3);
		$remoteControl->offButtonWasPushed(3);
	}
}

RemoteLoader::main();