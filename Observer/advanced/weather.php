<?php

interface DisplayElementInterface
{
    public function display();
}

interface ObserverInterface
{
    public function update(float $temp, float $humidity, float $pressure);
}

interface SubjectInterface
{
    public function registerObserver(ObserverInterface $observer);
	public function removeObserver(ObserverInterface $observer);
	public function notifyObservers();
}

class WeatherData implements SubjectInterface
{
    private $observers = [];
    private $temperature;
	private $humidity;
	private $pressure;

    public function registerObserver(ObserverInterface $observer): void
    {
        $this->observers[] = $observer;
    }

    public function removeObserver(ObserverInterface $observer): void
    {
        foreach ($this->observers as $key => $value) {
            if ($value == $observer) {
                unset($this->observers[$key]);
            }
        }
    }

    public function notifyObservers(): void
    {
        foreach ($this->observers as $observer)
        {
            $observer->update($this->temperature, $this->humidity, $this->pressure);
        }
    }

	public function measurementsChanged()
    {
       $this->notifyObservers();
	}

	public function setMeasurements(float $temperature, float $humidity, float $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->measurementsChanged();
    }

	public function getTemperature()
    {
		return $this->temperature;
	}

	public function getHumidity()
    {
		return $this->humidity;
	}

	public function getPressure()
    {
		return $this->pressure;
	}
}

class CurrentConditionsDisplay implements ObserverInterface, DisplayElementInterface
{
    private $temperature;
    private $humidity;
    private $weatherData;

    public function __construct(WeatherData $weatherData)
    {
        $this->weatherData = $weatherData;
        $this->weatherData->registerObserver($this);
    }

    public function update(float $temperature, float $humidity, float $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->display();
    }

    public function display()
    {
        echo "Current conditions: " . $this->temperature .
            "F degrees and " . $this->humidity . "% humidity";
    }
}

class ForecastDisplay implements ObserverInterface, DisplayElementInterface
{
    private $currentPressure = 29.92;
	private $lastPressure;
	private $weatherData;

	public function __construct(WeatherData $weatherData)
    {
		$this->weatherData = $weatherData;
		$this->weatherData->registerObserver($this);
	}

    public function update(float $temp, float $humidity, float $pressure)
    {
        $this->lastPressure = $this->currentPressure;
        $this->currentPressure = $pressure;

        $this->display();
    }

	public function display()
    {
        echo "Forecast: ";
		if ($this->currentPressure > $this->lastPressure) {
            echo "Improving weather on the way! \n";
        } else if ($this->currentPressure == $this->lastPressure) {
            echo "More of the same \n";
        } else if ($this->currentPressure < $this->lastPressure) {
            echo "Watch out for cooler, rainy weather \n";
        }
	}
}

class HeatIndexDisplay implements ObserverInterface, DisplayElementInterface
{
    private $heatIndex = 0.0;
    private $weatherData;

	public function __construct(WeatherData $weatherData)
    {
		$this->weatherData = $weatherData;
		$this->weatherData->registerObserver($this);
	}

    public function update(float $t, float $rh, float $pressure)
    {
        $this->heatIndex = $this->computeHeatIndex($t, $rh);
        $this->display();
    }

	private function computeHeatIndex(float $t, float $rh)
    {
         $index = ((16.923 + (0.185212 * $t) + (5.37941 * $rh) - (0.100254 * $t * $rh)
            + (0.00941695 * ($t * $t)) + (0.00728898 * ($rh * $rh))
            + (0.000345372 * ($t * $t * $rh)) - (0.000814971 * ($t * $rh * $rh)) +
            (0.0000102102 * ($t * $t * $rh * $rh)) - (0.000038646 * ($t * $t * $t)) + (0.0000291583 *
                ($rh * $rh * $rh)) + (0.00000142721 * ($t * $t * $t * $rh)) +
            (0.000000197483 * ($t * $rh * $rh * $rh)) - (0.0000000218429 * ($t * $t * $t * $rh * $rh)) +
            0.000000000843296 * ($t * $t * $rh * $rh * $rh)) -
        (0.0000000000481975 * ($t * $t * $t * $rh * $rh * $rh)));
		return $index;
	}

	public function display()
    {
        echo "Heat index is " . $this->heatIndex . " \n";
	}
}

class StatisticsDisplay implements ObserverInterface, DisplayElementInterface
{
    private $maxTemp = 0.0;
	private $minTemp = 200;
	private $tempSum = 0.0;
	private $numReadings;
	private $weatherData;

	public function __construct(WeatherData $weatherData)
    {
		$this->weatherData = $weatherData;
        $this->weatherData->registerObserver($this);
	}

    public function update(float $temp, float $humidity, float $pressure)
    {
        $this->tempSum += $temp;
        $this->numReadings++;

        if ($temp > $this->maxTemp) {
            $this->maxTemp = $temp;
        }

        if ($temp < $this->minTemp) {
            $this->minTemp = $temp;
        }

        $this->display();
    }

	public function display()
    {
        echo "Avg/Max/Min temperature = " . ($this->tempSum / $this->numReadings)
            . "/" . $this->maxTemp . "/" . $this->minTemp . " \n";
	}
}

class WeatherStation
{
    public static function main()
    {
        $weatherData = new WeatherData();

        $currentDisplay = new CurrentConditionsDisplay($weatherData);
        $statisticsDisplay = new StatisticsDisplay($weatherData);
        $forecastDisplay = new ForecastDisplay($weatherData);

        $weatherData->setMeasurements(80, 65, 30.4);
        $weatherData->setMeasurements(82, 70, 29.2);
        $weatherData->setMeasurements(78, 90, 29.2);

        $weatherData->removeObserver($forecastDisplay);
        $weatherData->setMeasurements(62, 90, 28.1);
    }
}

class WeatherStationHeatIndex
{
    public static function main()
    {
        $weatherData = new WeatherData();
        $currentDisplay = new CurrentConditionsDisplay($weatherData);
        $statisticsDisplay = new StatisticsDisplay($weatherData);
        $forecastDisplay = new ForecastDisplay($weatherData);
        $heatIndexDisplay = new HeatIndexDisplay($weatherData);

		$weatherData->setMeasurements(80, 65, 30.4);
		$weatherData->setMeasurements(82, 70, 29.2);
		$weatherData->setMeasurements(78, 90, 29.2);
	}
}

WeatherStation::main();
WeatherStationHeatIndex::main();