<?php

interface HtmlElement
{
    public function toHtml();
    public function getName();
}

class InputText implements HtmlElement
{

    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function toHtml()
    {
        return "<input type='text' name=\"{$this->name}\" placeholder='فیلد مورد نظر را پر کنید' id=\"{$this->name}\">";
    }

    public function getName()
    {
        return $this->name;
    }
}

abstract class HtmlDecorator implements HtmlElement
{
    protected $element;
    public function __construct(HtmlElement $element)
    {
        $this->element = $element;
    }

    abstract public function toHtml();

    public function getName()
    {
        return $this->element->getName();
    }
}

class LabelDecorator extends HtmlDecorator
{
    protected $label;
    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function toHtml()
    {
        return "<label for=\"{$this->element->getName()}\" class=\"label-control\">{$this->label}</label>" . $this->element->toHtml();
    }
}

class ErrorDecorator extends HtmlDecorator
{
    protected $error;

    public function setError($error)
    {
        $this->error = $error;
    }

    public function toHtml()
    {
        return $this->element->toHtml() . "<span class='text-danger'>{$this->error}</span>";
    }
}

$input1 = new inputText('firstName');
$labelInput1 = new LabelDecorator($input1);
$labelInput1->setLabel('lastName: ');
writeLn($labelInput1->toHtml());

$input2 = new inputText('lastName');
$label = new LabelDecorator($input2);
$label->setLabel('firstName: ');
$error = new ErrorDecorator($label);
$error->setError('لطفا فیلد را پر نمایید.');
writeLn($error->toHtml());


function writeLn($line_ln) {
    print_r($line_ln);
    echo '<br>';
}