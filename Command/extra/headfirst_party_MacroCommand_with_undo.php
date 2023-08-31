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

interface CommandInterface
{
    public function execute();
	public function undo();
}

class CeilingFanHighCommand implements CommandInterface
{
    protected $ceilingFan;
    protected $prevSpeed;

    public function __construct(CeilingFan $ceilingFan)
    {
		$this->ceilingFan = $ceilingFan;
	}

    public function execute()
    {
        $this->prevSpeed = $this->ceilingFan->getSpeed();
        $this->ceilingFan->high();
	}

	public function undo() {
		switch ($this->prevSpeed) {
            case $this->ceilingFan::HIGH: 	$this->ceilingFan->high(); break;
            case $this->ceilingFan::MEDIUM: $this->ceilingFan->medium(); break;
            case $this->ceilingFan::LOW: 	$this->ceilingFan->low(); break;
            default: 				        $this->ceilingFan->off(); break;
        }
	}
}

class CeilingFanMediumCommand implements CommandInterface
{
    protected $ceilingFan;
    protected $prevSpeed;

    public function __construct(CeilingFan $ceilingFan)
    {
        $this->ceilingFan = $ceilingFan;
    }

    public function execute()
    {
        $this->prevSpeed = $this->ceilingFan->getSpeed();
        $this->ceilingFan->medium();
    }

    public function undo() {
        switch ($this->prevSpeed) {
            case $this->ceilingFan::HIGH: 	$this->ceilingFan->high(); break;
            case $this->ceilingFan::MEDIUM: $this->ceilingFan->medium(); break;
            case $this->ceilingFan::LOW: 	$this->ceilingFan->low(); break;
            default: 				        $this->ceilingFan->off(); break;
        }
    }
}

class CeilingFanOffCommand implements CommandInterface
{
    protected $ceilingFan;
    protected $prevSpeed;

    public function __construct(CeilingFan $ceilingFan)
    {
        $this->ceilingFan = $ceilingFan;
    }

    public function execute()
    {
        $this->prevSpeed = $this->ceilingFan->getSpeed();
        $this->ceilingFan->off();
    }

    public function undo() {
        switch ($this->prevSpeed) {
            case $this->ceilingFan::HIGH: 	$this->ceilingFan->high(); break;
            case $this->ceilingFan::MEDIUM: $this->ceilingFan->medium(); break;
            case $this->ceilingFan::LOW: 	$this->ceilingFan->low(); break;
            default: 				        $this->ceilingFan->off(); break;
        }
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

	public function circulate()
    {
		if ($this->on) {
            echo "Hottub is bubbling! \n";
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
        if ($temperature > $this->temperature) {
            echo "Hottub is heating to a steaming " . $temperature . " degrees \n";
        } else {
            echo "Hottub is cooling to  " . $temperature . " degrees \n";
        }
        $this->temperature = $temperature;
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
        $this->hottub->setTemperature(98);
        $this->hottub->off();
    }

	public function undo()
    {
        $this->hottub->on();
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
        $this->hottub->on();
        $this->hottub->setTemperature(104);
        $this->hottub->circulate();
    }

    public function undo()
    {
        $this->hottub->off();
    }
}

class Light
{
    protected $location;
    protected $level;

    public function __construct(string $location)
    {
		$this->location = $location;
	}

    public function on()
    {
        $this->level = 100;
        echo "Light is on \n";
	}

    public function off()
    {
        $this->level = 0;
        echo "Light is off \n";
    }

    public function dim(int $level)
    {
        $this->level = $level;
        if ($level == 0) {
            $this->off();
        }
        else {
            echo "Light is dimmed to " . $level . "%" . "\n";
        }
    }

	public function getLevel()
    {
		return $this->level;
	}
}

class LightOffCommand implements CommandInterface
{
    protected $light;

    public function __construct(Light $light)
    {
		$this->light = $light;
	}

    public function execute()
    {
        $this->light->off();
	}

	public function undo()
    {
        $this->light->on();
	}
}

class LightOnCommand implements CommandInterface
{
    protected $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute()
    {
        $this->light->on();
    }

    public function undo()
    {
        $this->light->off();
    }
}

class LivingroomLightOffCommand implements CommandInterface
{
    protected $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute()
    {
        $this->light->off();
    }

    public function undo()
    {
        $this->light->on();
    }
}

class LivingroomLightOnCommand implements CommandInterface
{
    protected $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute()
    {
        $this->light->on();
    }

    public function undo()
    {
        $this->light->off();
    }
}

class Stereo
{
    protected $location;

    public function __construct(string $location)
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

    public function undo()
    {
        $this->stereo->on();
    }

}

class StereoOnCommand implements CommandInterface
{
    protected $stereo;

    public function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    public function execute()
    {
        $this->stereo->on();
    }

    public function undo()
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

    public function undo()
    {
        $this->stereo->off();
    }

}

class MacroCommand implements CommandInterface
{
    protected $commands = [];

    public function __construct(array $commands)
    {
		$this->commands = $commands;
	}

    public function execute()
    {
        for ($i = 0; $i < count($this->commands); $i++) {
            $this->commands[$i]->execute();
        }
	}

    /**
     * NOTE:  these commands have to be done backwards to ensure
     * proper undo functionality
     */
	public function undo() {
		for ($i = count($this->commands) -1; $i >= 0; $i--) {
            $this->commands[$i]->undo();
        }
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
        echo $this->location . " TV is on \n";
	}

    public function off() {
        echo $this->location . " TV is off \n";
    }


	public function setInputChannel() {
        $this->channel = 3;
        echo $this->location . " TV channel is set for DVD \n";
	}
}

class TVOffCommand implements CommandInterface
{
    protected $tv;

    public function __construct(TV $tv)
    {
		$this->tv= $tv;
	}

    public function execute()
    {
        $this->tv->off();
	}

    public function undo()
    {
        $this->tv->on();
    }
}

class TVOnCommand implements CommandInterface
{
    protected $tv;

    public function __construct(TV $tv)
    {
        $this->tv= $tv;
    }

    public function execute()
    {
        $this->tv->on();
        $this->tv->setInputChannel();
    }

    public function undo()
    {
        $this->tv->off();
    }
}

class NoCommand implements CommandInterface
{
    public function execute() { }
    public function undo() { }
}

class RemoteControl {
    protected $onCommands = [];
    protected $offCommands = [];
    protected $undoCommand = [];

    public function __construct(){}

    public function setCommand(int $slot, CommandInterface $onCommand, CommandInterface $offCommand)
    {
        $this->onCommands[$slot] = $onCommand;
        $this->offCommands[$slot] = $offCommand;
    }

	public function onButtonWasPushed(int $slot)
    {
        $this->onCommands[$slot]->execute();
        $this->undoCommand = $this->onCommands[$slot];
    }

	public function offButtonWasPushed(int $slot)
    {
        $this->offCommands[$slot]->execute();
        $this->undoCommand = $this->offCommands[$slot];
    }

	public function undoButtonWasPushed()
    {
        $this->undoCommand->undo();
	}
}

class RemoteLoader {

    public static function main() {

        $remoteControl = new RemoteControl();

        $light = new Light("Living Room");
		$tv = new TV("Living Room");
        $stereo = new Stereo("Living Room");
        $hottub = new Hottub();

        $lightOn = new LightOnCommand($light);
        $stereoOn = new StereoOnCommand($stereo);
        $tvOn = new TVOnCommand($tv);
        $hottubOn = new HottubOnCommand($hottub);
        $lightOff = new LightOffCommand($light);
        $stereoOff = new StereoOffCommand($stereo);
        $tvOff = new TVOffCommand($tv);
        $hottubOff = new HottubOffCommand($hottub);

		$partyOn = [ $lightOn, $stereoOn, $tvOn, $hottubOn];
        $partyOff = [ $lightOff, $stereoOff, $tvOff, $hottubOff];

        $partyOnMacro = new MacroCommand($partyOn);
        $partyOffMacro = new MacroCommand($partyOff);

		$remoteControl->setCommand(0, $partyOnMacro, $partyOffMacro);

        print_r($remoteControl);
        echo "--- Pushing Macro On--- \n";
        $remoteControl->onButtonWasPushed(0);
        echo "--- Pushing Macro Off--- \n";
        $remoteControl->offButtonWasPushed(0);
	}
}

RemoteLoader::main();