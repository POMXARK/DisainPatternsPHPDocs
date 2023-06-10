<?php

interface ButtonInterface
{
    public function draw();
}

interface CheckBoxInterface
{
    public function draw();
}

interface GuiKitFactoryInterface
{
    public function buildButton(): ButtonInterface;

    public function buildCheckBox(): CheckBoxInterface;
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

class BootstrapFactory implements GuiKitFactoryInterface
{

    public function buildButton(): ButtonInterface
    {
        return new ButtonBootstrap();
    }

    public function buildCheckBox(): CheckBoxInterface
    {
        return new CheckBoxBootstrap();
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

class SemanticUiFactory implements GuiKitFactoryInterface
{

    public function buildButton(): ButtonInterface
    {
        return new ButtonSemanticUi();
    }

    public function buildCheckBox(): CheckBoxInterface
    {
        return new CheckBoxSemanticUi();
    }
}

class GuiKitFactory
{
    /**
     * @throws Exception
     */
    public function getFactory($type): GuiKitFactoryInterface
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

        $result[] = $this->guiKit->buildButton()->draw();
        $result[] =$this->guiKit->buildCheckBox()->draw();

        print_r($result);
    }
}

new GuiTheme('bootstrap');

new GuiTheme('semanticui');