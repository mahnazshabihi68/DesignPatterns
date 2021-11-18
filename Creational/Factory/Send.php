<?php

abstract class SendMessages
{
    public $text;
   
    abstract public function createSend(): SendMsg;

    public function sendText($text): string
    {
        $product = $this->createSend();

        $result = $product->send($text);

        return $result;
    }
}

class SmsSend extends SendMessages
{
   
    public function createSend(): SendMsg
    {
        return new Sms();
    }
}

class EmailSend extends SendMessages
{
    public function createSend(): SendMsg
    {
        return new Email();
    }
}


interface SendMsg
{
    public function send($text): string;
}

class Sms implements SendMsg
{
    public function send($text): string
    {
        return $text;
    }
}

class Email implements SendMsg
{
    public function send($text): string
    {
        return $text;
    }
}

function clientCode(SendMessages $sendMessage)
{
    // ...
    echo $sendMessage->sendText('hi') .'<br>';


    echo $sendMessage->sendText('wellcom') . '<br>';
    // ...
}

clientCode(new SmsSend());
echo "\n\n";

clientCode(new EmailSend());
