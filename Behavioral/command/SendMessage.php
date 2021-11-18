<?php

class Message {
    protected $queue = [];

    public function addMessage(IMessageSender $sender)
    {
        $this->queue[] = $sender;
    }

    public function executeQueue()
    {
        foreach ($this->queue as $sender) {
            $statusSendingMessage = false;
            while (! $statusSendingMessage ) {
                $statusSendingMessage = $sender->sendMessage();
            }
        }
    }
}

interface IMessageSender {
    public function sendMessage();
}

class SendEmail implements IMessageSender {
    protected $title;
    protected $message;
    protected $emailAdress;

    /**
     * SendEmail constructor.
     * @param $title
     * @param $message
     * @param $emailAdress
     */
    public function __construct($title, $message, $emailAdress)
    {
        $this->title = $title;
        $this->message = $message;
        $this->emailAdress = $emailAdress;
    }

    public function sendMessage()
    {
        return 1;
//      $status = Mail::send();
//        return $status;
    }
}
class SendSms implements IMessageSender {
    protected $title;
    protected $message;
    protected $phonNumber;

    /**
     * SendEmail constructor.
     * @param $title
     * @param $message
     * @param $phonNumber
     */
    public function __construct($title, $message, $phonNumber)
    {
        $this->title = $title;
        $this->message = $message;
        $this->phonNumber = $phonNumber;
    }

    public function sendMessage()
    {
//      $status = api send sms
//        return $status;
    }
}


$messageQueue = new Message();
$messageQueue->addMessage(new SendEmail('php' , 'PHP is a popular general-purpose scripting language that is especially suited to web development.' , 'shabihi.mahnaz95@gmail.com'));

$messageQueue->executeQueue();
echo 'messages sent';