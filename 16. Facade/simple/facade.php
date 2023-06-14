<?php

/**
 * Реализации отдельных частей компьютера.
 * У каждого метода классов имеется какая-то реализация, в данном примере она опущена.
 */

/**
 * Class CPU, отвечает за работу процессора
 */
class CPU
{
    public function freeze() {}
    public function jump($position) {}
    public function execute() {}
}

/**
 * Class Memory, отвечает за работу памяти
 */
class Memory
{
    const BOOT_ADDRESS = 0x0005;
    public function load($position, $data) {}
}

/**
 * Class HardDrive, отвечает за работу жёсткого диска
 */
class HardDrive
{
    const BOOT_SECTOR = 0x001;
    const SECTOR_SIZE = 64;
    public function read($lba, $size) {}
}

/**
 * Пример шаблона "Фасад"
 * В качестве унифицированного объекта выступает Компьютер.
 * За этим объектом будут скрыты все детали работы его внутренних частей.
 */
class Computer
{
    protected $cpu;
    protected $memory;
    protected $hardDrive;

    /**
     * Computer constructor.
     * Инициализируем части
     */
    public function __construct()
    {
        $this->cpu = new CPU();
        $this->memory = new Memory();
        $this->hardDrive = new HardDrive();
    }

    /**
     * Упрощённая обработка поведения "запуск компьютера"
     */
    public function startComputer()
    {
        $cpu = $this->cpu;
        $memory = $this->memory;
        $hardDrive = $this->hardDrive;

        $cpu->freeze();
        $memory->load(
            $memory::BOOT_ADDRESS,
            $hardDrive->read($hardDrive::BOOT_SECTOR, $hardDrive::SECTOR_SIZE)
        );
        $cpu->jump($memory::BOOT_ADDRESS);
        $cpu->execute();
    }
}

/**
 * Пользователям компьютера предоставляется Фасад (компьютер),
 * который скрывает все сложность работы с отдельными компонентами.
 */
$computer = new Computer();
$computer->startComputer();