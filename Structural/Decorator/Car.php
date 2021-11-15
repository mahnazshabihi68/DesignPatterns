<?php


interface CarInterface
{
    public function cost();
    public function description();
}

class BMW implements CarInterface
{
    public function cost()
    {
        return 90000;
    }

    public function description()
    {
        return 'this car is BMW';
    }
}


abstract class CarFeature implements CarInterface
{
    protected $car;

    public function __construct(CarInterface $car)
    {
        $this->car = $car;
    }

    abstract public function cost();
    abstract public function description();
}

class SunRoof extends CarFeature
{
    public function cost()
    {
        return $this->car->cost() + 5000;
    }

    public function description()
    {
        return 'with sunRoof';
    }
}

class lastSpeedButton extends CarFeature
{
    public function cost()
    {
        return $this->car->cost() + 10000;
    }

    public function description()
    {
        return 'with lastSpeed button';
    }
}

$car = new BMW();
$price = $car->cost();
writeln('car price: ');
writeln($price);

$carWithSunRoof = new SunRoof($car);
$priceWithSunRoof = $carWithSunRoof->cost();
writeln('car price with sunroof: ');
writeln($priceWithSunRoof);

$carWithSunRoofAndLastSpeedButton = new lastSpeedButton($carWithSunRoof);
$priceWithSunRoofAndLastSpeedButton = $carWithSunRoofAndLastSpeedButton->cost();
writeln('car price with sunroof and last speed button: ');
writeln($priceWithSunRoofAndLastSpeedButton);


function writeln($line_ln) {
    print_r($line_ln);
    echo '<br>';
}