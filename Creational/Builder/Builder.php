<?php

/**
 * The Builder interface specifies methods for creating the different parts of
 * the House objects.
 */
interface Builder
{
    public function SetRoof(): void; 
    public function SetDoors(): void; 
    public function SetWindows(): void; 
    public function SetRooms(): void; 
    public function SetGarden(): void; 
    public function SetSwimmingPools(): void; 
}


class HouseBuilder implements Builder
{
    private $house;

     /**
     * A fresh builder instance should contain a blank House object, which is
     * used in further assembly.
     */
    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->house = new House;
    }

     /**
     * All production steps work with the same house instance.
     */
    public function SetRoof(): void
    {
        $this->house->parts[] = 'set roof';
    }

    public function SetDoors(): void
    {
        $this->house->parts[] = 'set doors';
    }

    public function SetWindows(): void
    {
        $this->house->parts[] = 'set windoes';
    }

    public function SetRooms(): void
    {
        $this->house->parts[] = 'set rooms';
    }

    public function SetGarden(): void
    {
        $this->house->parts[] = 'set garden';
    }

    public function SetSwimmingPools(): void
    {
        $this->house->parts[] = 'set swimming pools';
    }

    public function getHouse() : House
    {
        $house = $this->house;
        $this->reset();

        return $house;
    }
}


class House
{
    public $parts = [];

    public function listParts() : void
    {
        echo "House Parts: " . implode(',', $this->parts) . "\n\n";
    }
}

/**
 * The Director is only responsible for executing the building steps in a
 * particular sequence. It is helpful when producing products according to a
 * specific order or configuration. Strictly speaking, the Director class is
 * optional, since the client can control builders directly.
 */
class Director  
{
    private $builder;

    public function setBuilder(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function BuildMinimalViableHouse()
    {
        $this->builder->SetDoors();
        $this->builder->SetRoof();
        $this->builder->SetWindows();
    }

    public function BuildMediumFeturedHouse()
    {
        $this->builder->SetDoors();
        $this->builder->SetRoof();
        $this->builder->SetWindows();
        $this->builder->SetRooms();
        $this->builder->SetGarden();
        $this->builder->SetSwimmingPools();
    }
}

/**
 * The client code creates a builder object, passes it to the director and then
 * initiates the construction process. The end result is retrieved from the
 * builder object.
 */
function clientCode(Director $director) {
    $house = new HouseBuilder();
    $director->setBuilder($house);
    $director->BuildMediumFeturedHouse();
    echo "Standard Medium House:\n";
    $house->getHouse()->listParts();

    // ‌Builder pattern can be used without a Director class 
    $room = new HouseBuilder();
    $room->SetDoors();
    $room->SetRoof();
    $room->SetWindows();
    echo "Standard Very Small House:\n";
    $room->getHouse()->listParts();
}

$director = new Director();
$res = clientCode($director);