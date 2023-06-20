<?php


class SpreadsheetCellIterator
{
    private $alphabet;

    private $coordinateLastCell;
    private $nextNumberCell;

    private $overflow;
    private $overflowNumber;

    const TOTAL_NUMBER_COLUMNS = 52;

    private $totalColumns = 0;

    public function __construct($startCoordinateCell = 'A')
    {
        $this->alphabet =  range('A','Z');
        $this->coordinateLastCell = $startCoordinateCell;
        $this->nextNumberCell = array_search($this->coordinateLastCell, $this->alphabet);
    }

    public function nextCell()
    {
        if($this->totalColumns >= self::TOTAL_NUMBER_COLUMNS) {
            throw new \Exception('Достигнут предел количества колонок');
        }

        if ($this->nextNumberCell >= count($this->alphabet)) {
            if ($this->overflow == null) {
                $this->overflow = 'A';
                $this->nextNumberCell = 0;
            }
            $this->overflowNumber = array_search($this->coordinateLastCell, $this->alphabet);
            $this->overflow = $this->alphabet[$this->overflowNumber];
        }

        $latter = $this->alphabet[$this->nextNumberCell];
        $this->nextNumberCell += 1;

        $this->totalColumns += 1;

        return $this->overflow . $latter;
    }
}

$iter = new SpreadsheetCellIterator();
foreach (range(0, 51) as $i)
{
    echo ($iter->nextCell()) . "\n";
}