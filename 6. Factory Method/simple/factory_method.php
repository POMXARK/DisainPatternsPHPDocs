<?php

interface ButtonInterface
{
    public function draw();
}

interface CheckBoxInterface
{
    public function draw();
}

interface GuiFactoryInterface
{
    public function buildButton(): ButtonInterface;

    public function buildCheckBox(): CheckBoxInterface;
}

interface FormInterface
{
    public function render();

    function createGuiKit(): GuiFactoryInterface;
}

abstract class AbstractForm implements FormInterface
{
    /**
     * Рисуем форму
     *
     * @return array
     */
    public function render()
    {
        $guiKit = $this->createGuiKit();
        $result[] = $guiKit->buildCheckBox()->draw();
        $result[] = $guiKit->buildButton()->draw();

        return $result;
    }

    /**
     * Получаем инструментарий для рисования обьектов формы
     *
     * @return GuiFactoryInterface
     */
    abstract function createGuiKit(): GuiFactoryInterface;
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

class BootstrapFactory implements GuiFactoryInterface
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


class BootstrapDialogForm extends AbstractForm
{
    function createGuiKit(): GuiFactoryInterface
    {
        return new BootstrapFactory();
    }
}

class SemanticUiFactory implements GuiFactoryInterface
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

class SemanticUiDialogForm extends AbstractForm
{
    function createGuiKit(): GuiFactoryInterface
    {
        return new SemanticUiFactory();
    }
}

$dialogForm = new BootstrapDialogForm();
print_r($dialogForm->render());

$dialogForm = new SemanticUiDialogForm();
print_r($dialogForm->render());