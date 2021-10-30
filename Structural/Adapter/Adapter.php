<?php

/**
 * The Gateway defines the domain-specific used by the client code.
 */
class Gateway
{
    public function sendPayment($amount)
    {
        echo "Paying via This Gateway: " . $amount;
    }
}

/**
 * The Adaptee contains some useful behavior, but its interface is incompatible
 * with the existing client code. The Adaptee needs some adaptation before the
 * client code can use it.
 */
class Mellat
{
    public function doPayment($amount)
    {
        echo "Paying via Mellat Gateway: " . $amount;
    }
}

/**
 * The Adapter makes the Adaptee's interface compatible with the Target's
 * interface.
 */
class PaymentAdapter extends Gateway
{
    private $mellat;
    public function __construct(Mellat $mellat)
    {
        $this->mellat = $mellat;
    }

    public function sendPayment($amount)
    {
        $this->mellat->doPayment($amount);
    }
}


/**
 * The client code supports all classes that follow the PaymentInterface.
 */
function clientCode(Gateway $gateway)
{
    echo $gateway->sendPayment(90000);
}


echo "Client: I can work just fine with the Gateway objects:\n";
$gateway = new Gateway();
clientCode($gateway);
echo "\n\n";

echo "Client: I can work just fine with the Mellat objects:\n";
$mellatGateway = new Mellat();
$mellatGateway->doPayment(50, 000, 000);
echo "\n\n";

echo "Client: But I can work with it via the PaymentAdapter:\n";
$adapter = new PaymentAdapter(new Mellat());
clientCode($adapter);
