<?php
class Program
{
    static function main()
    {
        /** Этап иницилизации компоновщика  */
        $fileSystem = new DirectoryHandler("Файловая система");

        /** Этап  иницилизации компонентов  */
        // определяем новый диск
        $diskC = new DirectoryHandler("Диск С");
        // новые файлы
        $pngFile = new File("12345.png");
        $docxFile = new File("Document.docx");

        /** Этап  создания иерархии компонентов  */
        // добавляем файлы на диск С
        $diskC->add($pngFile);
        $diskC->add($docxFile);
        // добавляем диск С в файловую систему
        $fileSystem->add($diskC);

        /** Этап последовательного запуска общих методов для связанной иерархии компонентов */
        // выводим все данные
        $fileSystem->print();
        // удаляем с диска С файл
        $diskC->remove($pngFile);

        /** Этап иницилизации другого компоновщика  */
        // создаем новую папку
        $docsFolder = new DirectoryHandler("Мои Документы");

        /** Этап  иницилизации компонентов  */
        // добавляем в нее файлы
        $txtFile = new File("readme.txt");
        $csFile = new File("Program.cs");

        /** Этап  создания иерархии компонентов  */
        $docsFolder->add($txtFile);
        $docsFolder->add($csFile);
        $diskC->add($docsFolder);

        /** Этап последовательного запуска общих методов для связанной иерархии компонентов */
        $docsFolder->print();
    }
}

abstract class Component
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public abstract function add(Component $component);

    public abstract function remove(Component $component);

    public function print()
    {
        echo 'print ' . $this->name . "\n";
    }
}

class DirectoryHandler extends Component
{
    private $components = [];

    public function add(Component $component)
    {
        $this->components[] = $component;
    }

    public function remove(Component $component)
    {
        foreach ($this->components as $key => $value){
            if ($value == $component) {
                unset($this->components[$key]);
            }
        }
    }

    public function print()
    {
       echo 'Узел ' . $this->name . "\n";
       echo 'Под узлы: ' . $this->name . "\n";

        for($i=0; $i< count($this->components); $i++)
        {
            $this->components[$i]->print();
        }
    }
}

class File extends Component
{
    public function add(Component $component)
    {

    }

    public function remove(Component $component)
    {

    }
}

Program::main();