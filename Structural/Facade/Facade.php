<?php

interface ShareInterface
{
    public function setMessage($message);
    public function share();
}

class Twitter implements ShareInterface
{
    private $message;

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function share()
    {
        echo "Sharing by $this->message on Twitter.<br/>";
    }
}

class GooglePlus implements ShareInterface
{
    private $message;

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function share()
    {
        echo "Sharing by $this->message on GooglePlus.<br/>";
    }
}

class Facebook implements ShareInterface
{
    private $message;

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function share()
    {
        echo "Sharing by $this->message on facebook.<br/>";
    }
}

/**
 * The Facade class provides a simple interface to the complex logic of one or
 * several subsystems. The Facade delegates the client requests to the
 * appropriate objects within the subsystem. The Facade is also responsible for
 * managing their lifecycle. All of this shields the client from the undesired
 * complexity of the subsystem.
 */
class SocialMediaFacade
{
    private $twitter;
    private $googlePlus;
    private $facebook;

    /**
     * Depending on your application's needs, you can provide the Facade with
     * existing subsystem objects or force the Facade to create them on its own.
     */
    public function __construct(Twitter $twitter, GooglePlus $googlePlus, Facebook $facebook)
    {
        $this->twitter = $twitter;
        $this->googlePlus = $googlePlus;
        $this->facebook = $facebook;
    }

    public function setMessage($message)
    {
        $this->twitter->setMessage($message);
        $this->googlePlus->setMessage($message);
        $this->facebook->setMessage($message);
        return $this;
    }

    /**
     * The Facade's methods are convenient shortcuts to the sophisticated
     * functionality of the subsystems. However, clients get only to a fraction
     * of a subsystem's capabilities.
     */
    public function share()
    {
        $this->twitter->share();
        $this->googlePlus->share();
        $this->facebook->share();
    }
}

/**
 * The client code works with complex subsystems through a simple interface
 * provided by the Facade. When a facade manages the lifecycle of the subsystem,
 * the client might not even know about the existence of the subsystem. This
 * approach lets you keep the complexity under control.
 */
function clientCode(SocialMediaFacade $facade)
{
    $facade->share();
}

/**
 * The client code may have some of the subsystem's objects already created. In
 * this case, it might be worthwhile to initialize the SocialMediaFacade with these objects
 * instead of letting the SocialMediaFacade create new instances.
 */
clientCode(new SocialMediaFacade(new Twitter, new GooglePlus, new Facebook));

// $socialMedia = new SocialMediaFacade(new Twitter, new GooglePlus, new Facebook);
// $socialMedia->share();
