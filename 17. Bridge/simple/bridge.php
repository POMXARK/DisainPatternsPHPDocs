<?php
trait TData
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->prepare();
    }
    abstract protected function prepare();
}

trait TShow
{
    private $content;

    public function show()
    {
        print $this->content;
    }
}

class XmlFormat
{
    use TData, TShow;

    protected function prepare()
    {
        $this->content = '<?xml version="1.1" encoding="UTF-8" ?><root>';
        foreach ($this->data as $name => $item) {
            $this->content .= "<$name>$item</$name>";
        }
        $this->content .= '</root>';
    }
}

class JsonFormat
{
    use TData, TShow;

    protected function prepare()
    {
        $this->content = json_encode($this->data);
    }
}

class SelfFormat
{
    use TData, TShow;

    protected function prepare()
    {
        $content = array();
        foreach ($this->data as $name => $item) {
            $string = '';
            if (is_string($name)) {
                $nLen = strlen($name);
                $string .= "[name|string({$nLen}){{$name}}:val|";
            }
            if (is_int($name)) {
                $string .= "[index|int{{$name}}:val|";
            }
            if (is_string($item)) {
                $vLen = strlen($item);
                $string .= "string($vLen){{$item}";
            }
            if (is_int($item)) {
                $string .= "int{{$item}";
            }
            $string .= "}]";
            array_push($content, $string);
        }
        $this->content = 'selfMadeDataFormat:Array('.count($this->data).'):';
        $this->content .= implode(',', $content);
        $this->content .= ':endSelfMadeDataFormat';
    }
}

$xml = new XmlFormat(array('a' => 'b', 'c'));
$json = new JsonFormat(array('a' => 'b', 'c'));
$self = new SelfFormat(array('a' => 'b', 'c'));
$self->show(); /* selfMadeDataFormat:Array(2):[name|string(1){a}:val|string(1){b}],[index|int{0}:val|string(1){c}]:endSelfMadeDataFormat */
$xml->show(); /* <?xml version="1.1" encoding="UTF-8" ?><root><a>b</a><0>c</0></root> */
$json->show(); /* {"a":"b","0":"c"} */