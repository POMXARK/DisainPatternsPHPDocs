<?php

interface  GuiKitFactoryInterface
{
    public static function build($type);
}

interface ButtonInterface
{
    public function draw();
}

interface CheckBoxInterface
{
    public function draw();
}


class ButtonBootstrap implements ButtonInterface
{
    public function draw(): string
    {
        return __CLASS__;
    }
}

class CheckBoxBootstrap implements CheckBoxInterface
{
    public function draw(): string
    {
        return __CLASS__;
    }
}

class BootstrapFactory
{
    public static function build(string $type): ButtonBootstrap|CheckBoxBootstrap|int
    {
        return match ($type) {
            'button' => new ButtonBootstrap(),
            'checkbox' => new CheckBoxBootstrap(),
            default => 1,
        };
    }
}

class ButtonSemanticUi implements ButtonInterface
{
    public function draw(): string
    {
        return __CLASS__;
    }
}

class CheckBoxSemanticUi implements CheckBoxInterface
{
    public function draw(): string
    {
        return __CLASS__;
    }
}

class SemanticUiFactory
{
    public static function build(string $type): ButtonSemanticUi|CheckBoxSemanticUi|int
    {
        return match ($type) {
            'button' => new ButtonSemanticUi(),
            'checkbox' => new CheckBoxSemanticUi(),
            default => 1,
        };
    }
}

class GuiKitFactory
{
    /**
     * @throws Exception
     */
    public function getFactory($type)
    {
        switch ($type) {
            case 'bootstrap':
                $factory = new BootstrapFactory();
                break;
            case 'semanticui':
                $factory = new SemanticUiFactory();
                break;
            default:
                throw new \Exception("Неизвестный тип фабрики [{$type}]");
        }

        return $factory;
    }
}

class GuiTheme
{
    private $guiKit;

    public function __construct(string $guiKit) {
        $this->guiKit = (new GuiKitFactory())->getFactory($guiKit);

        $result[] = $this->guiKit::build('button')->draw();
        $result[] =$this->guiKit::build('checkbox')->draw();

        print_r($result);
    }
}

new GuiTheme('bootstrap');

new GuiTheme('semanticui');