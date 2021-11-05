<?php

/**
 * The Logistic class declares the factory method that is supposed to return an
 * object of a Product class. The Logistic's subclasses usually provide the
 * implementation of this method.
 */
abstract class Logistic
{
    public $place;
    /**
     * Note that the Logistic may also provide some default implementation of the
     * factory method.
     */
    abstract public function createTransport(): Product;

    /**
     * Also note that, despite its name, the Logistic's primary responsibility is
     * not creating products. Usually, it contains some core business logic that
     * relies on Product objects, returned by the factory method. Subclasses can
     * indirectly change that business logic by overriding the factory method
     * and returning a different type of product from it.
     */
    public function planDelivery($place): string
    {
        // Call the factory method to create a Product object.
        $product = $this->createTransport();
        // Now, use the product.
        $result = $product->deliver($place);

        return $result;
    }
}

/**
 * Concrete Creators override the factory method in order to change the
 * resulting product's type.
 */
class RoadLogistic extends Logistic
{
    /**
     * Note that the signature of the method still uses the abstract product
     * type, even though the concrete product is actually returned from the
     * method. This way the Creator can stay independent of concrete product
     * classes.
     */
    public function createTransport(): Product
    {
        return new Truck();
    }
}

class SeaLogistic extends Logistic
{
    public function createTransport(): Product
    {
        return new Ship();
    }
}

/**
 * The Product interface declares the operations that all concrete products must
 * implement.
 */
interface Product
{
    public function deliver($place): string;
}

/**
 * Concrete Products provide various implementations of the Product interface.
 */
class Truck implements Product
{
    public function deliver($place): string
    {
        return "Delivered to " . $place . " of road";
    }
}

class Ship implements Product
{
    public function deliver($place): string
    {
        return "Delivered to " . $place . " of sea";
    }
}

function clientCode(Logistic $logistic)
{
    // ...
    echo "Client: I'm not aware of the Logistic's class, but it still works.\n"
        . $logistic->planDelivery('tehran');


    echo "Client: I'm not aware of the Logistic's class, but it still works.\n"
        . $logistic->planDelivery('zanjan');
    // ...
}

echo "App: Launched with the ConcreteCreator1.\n";
clientCode(new RoadLogistic());
echo "\n\n";

echo "App: Launched with the ConcreteCreator2.\n";
clientCode(new SeaLogistic());
