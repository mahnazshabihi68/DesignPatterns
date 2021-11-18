<?php
/**
 * Class Calculator
 *
 * this is the (Receiver) class of the command pattern,
 * it receives and contains the actual operations
 * and their implementations
 */
class Calculator
{
    private $num1;
    private $num2;

    public function __construct($num1, $num2)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }

    public function add()
    {
        return $this->num1 + $this->num2;
    }

    public function subtract()
    {
        return $this->num1 - $this->num2;
    }

    public function multiply()
    {
        return $this->num1 * $this->num2;
    }

    public function divide()
    {
        return $this->num1 / $this->num2;
    }

    public function setNum1($num1)
    {
        $this->num1 = $num1;
    }

    public function setNum2($num2)
    {
        $this->num2 = $num2;
    }
}

/**
 * Interface CalculatorCommandInterface
 *
 * The command interface contains just one method execute that need to be implemented
 * in every concrete command
 *
 */
interface CalculatorCommandInterface
{
    public function execute();
}

/**
 * Class AddCommand
 *
 * Concrete command (AddCommand) implement command interface
 * injects the receiver class (Calculator) to access the
 * real operation, in this case (add) operation
 *
 */
class AddCommand implements CalculatorCommandInterface
{
    private $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function execute()
    {
        return $this->calculator->add();
    }
}

/**
 * Class SubtractCommand
 *
 * Concrete command (SubtractCommand) implement command interface
 *
 */
class SubtractCommand implements CalculatorCommandInterface
{
    private $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function execute()
    {
        return $this->calculator->subtract();
    }
}

/**
 * Class MultiplyCommand
 *
 * Concrete command (MultiplyCommand) implement command interface
 *
 */
class MultiplyCommand implements CalculatorCommandInterface
{
    private $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function execute()
    {
        return $this->calculator->multiply();
    }
}

/**
 * Class DivideCommand
 *
 * Concrete command (DivideCommand) implement command interface
 *
 */
class DivideCommand implements CalculatorCommandInterface
{
    private $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function execute()
    {
        return $this->calculator->divide();
    }
}

/**
 * Class CommandInvoker
 *
 * Command invoker set commands and execute them
 *
 */
class CommandInvoker
{
    private $command;
    public function __construct(CalculatorCommandInterface $command)
    {
        $this->command = $command;
    }
    public function setCommand(CalculatorCommandInterface $command)
    {
        $this->command = $command;
    }
    public function handle()
    {
        return $this->command->execute();
    }
}

$calculator = new Calculator($argv[1], $argv[2]);

$invoker = new CommandInvoker(new AddCommand($calculator));

$output = $invoker->handle();

echo $output . "\n";
