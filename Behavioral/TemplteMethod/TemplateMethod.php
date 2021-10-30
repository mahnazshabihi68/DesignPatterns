<?php

abstract class OrderProcess
{
    /**
     * @var string[]
     */
    private $thingsToDo = [];

    /**
     * This is the public service provided by this class and its subclasses.
     * Notice it is final to "freeze" the global behavior of algorithm.
     * If you want to override this contract, make an interface with only processOrder()
     * and subclass it.
     */
    final public function processOrder()
    {
        $this->thingsToDo[] = $this->doSelect();
        $this->thingsToDo[] = $this->doPayment();
        if (!is_null($this->isGift())) $this->thingsToDo[] = $this->isGift();
        $this->thingsToDo[] = $this->doDelivery();
    }

    protected function isGift()
    {
        return null;
    }

    abstract public function doSelect();
    abstract public function doPayment();

    public function giftWrap()
    {
        return 'Gift Wrap Successfull';
    }

    abstract public function doDelivery();

    public function getThingsToDo()
    {
        return $this->thingsToDo;
    }
}

/**
 * Concrete classes have to implement all abstract operations of the base class.
 * They can also override some operations with a default implementation.
 */
class SetOrder extends OrderProcess
{
    public function doSelect()
    {
        return "Customer chooses the item from shelf.";
    }

    public function doPayment()
    {
        return "Pays at counter through cash/POS";
    }

    public function doDelivery()
    {
        return "Item delivered to in delivery counter.";
    }
}

/**
 * Usually, concrete classes override only a fraction of base class' operations.
 */
class BuyGiftOrder extends OrderProcess
{
    protected function isGift()
    {
        return "Gift wrap successful";
    }

    public function doSelect()
    {
        return "Item added to online shopping cart \n Get gift wrap preference \n Get delivery address.";
    }

    public function doPayment()
    {
        return "Online Payment";
    }

    public function doDelivery()
    {
        return "Ship the item through post to delivery address";
    }
}

/**
 * The client code calls the template method to execute the algorithm. Client
 * code does not have to know the order class of an object it works with, as
 * long as it works with objects through the interface of their base class.
 */
function clientCode(OrderProcess $order)
{
    $order->processOrder();
    return $order;
}

print_r(clientCode(new BuyGiftOrder()));exit;
