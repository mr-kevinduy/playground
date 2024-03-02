<?php
// namespace KevinDuy\DesignPattern;

interface Product
{
    public function operation(): string;
}

abstract class Creator
{
    abstract public function factoryMethod(): Product;

    public function someOperation(): string
    {
        $product = $this->factoryMethod();

        $result = "Creator: The same creator's code has just worked with ".$product->operation();

        return $result;
    }
}

class ConcreteProduct1 implements Product
{
    public function operation(): string
    {
        return "Concrete Product 1";
    }
}

class ConcreteProduct2 implements Product
{
    public function operation(): string
    {
        return "Concrete Product 2";
    }
}

class ConcreteCreator1 extends Creator
{
    public function factoryMethod(): Product
    {
        return new ConcreteProduct1();
    }
}

class ConcreteCreator2 extends Creator
{
    public function factoryMethod(): Product
    {
        return new ConcreteProduct2();
    }
}

function clientCode(Creator $creator)
{
    echo "Client: I'm not aware of the creator's class, but it still works.\n"
        . $creator->someOperation();
}

echo "App: Launched with the ConcreteCreator1.\n";
clientCode(new ConcreteCreator1());
echo "\n\n";

echo "App: Launched with the ConcreteCreator2.\n";
clientCode(new ConcreteCreator2());
echo "\n";
