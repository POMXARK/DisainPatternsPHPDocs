<?php

interface MediaLibraryInterface
{
    /**
     * Загрузка изображения
     *
     * @param $pathFile
     * @return string
     */
    public function upload($pathFile): string;

    /**
     * Получить изображение по имени
     *
     * @param $fileCode
     * @return string Путь к файлу
     */
    public function get($fileCode): string;
}

interface MediaLibraryThirdPartyInterface
{
    /**
     * Загрузка изображения
     *
     * @param $pathFile
     * @return string
     */
    public function addMedia($pathFile): string;

    /**
     * Получить изображение по имени
     *
     * @param $fileCode
     * @return string Путь к файлу
     */
    public function getMedia($fileCode): string;
}

/**
 * Самописная библиотека работы с изображениями
 */
class MediaLibrarySelfWritten implements MediaLibraryInterface
{
    public function upload($pathFile): string
    {
        return md5(__METHOD__ . $pathFile);
    }

    public function get($fileCode): string
    {
        return '';
    }
}

/**
 * Сторонняя библиотека работы с изображениями
 * !!! Закрыта для модиикации !!!
 */
class MediaLibraryThirdParty implements MediaLibraryThirdPartyInterface
{
    public function addMedia($pathFile): string
    {
        return md5(__METHOD__ . $pathFile);
    }

    public function getMedia($fileCode): string
    {
        return '';
    }

    public function extraZip(){
        echo "Сжимаем изображение...";
        sleep(2);
    }
}

class MediaLibraryAdapter implements MediaLibraryInterface
{
    /** @var MediaLibraryThirdParty */
    private $adapterObj;

    public function __construct()
    {
        $this->adapterObj = new MediaLibraryThirdParty();
    }

    public function upload($pathFile): string
    {
        return $this->adapterObj->addMedia($pathFile);
    }

    public function get($fileCode): string
    {
        return $this->adapterObj->getMedia($fileCode);
    }

    /**
     * Обеспечивает обработку всех не обьявленых метод в адаптере
     * Вернет существующий метод из новой библеотеки
     *
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        if(method_exists($this->adapterObj, $name)) {
            return call_user_func_array([$this->adapterObj, $name], $arguments);
        } else {
            throw new \Exception("Метод ${name} не найден");
            }

    }
}

$mediaLibrary = new MediaLibraryAdapter();
print_r($mediaLibrary->upload('example.png'));
print_r($mediaLibrary->get('example.png'));
echo "\n";
print_r($mediaLibrary->extraZip('example.png'));
echo "\n";
print_r($mediaLibrary->superZip('example.png'));