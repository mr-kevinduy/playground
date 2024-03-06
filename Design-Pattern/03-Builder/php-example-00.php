<?php
/**
 * Example 00: Conceptual
 * 
 * - Builder: ConcreteBuilder1, ConcreteBuilder2
 * - Director
 * - Product
 * - Client
 * 
 * - Usage: php Design-Pattern/03-Builder/php-example-00.php
 */

abstract class Product
{
    public $parts = [];

    public function listParts(): void
    {
        echo "Product parts: " . implode(', ', $this->parts) . "\n\n";
    }
}

class Product1 extends Product
{
}

class Product2 extends Product
{
}

interface Builder
{
    public function producePartA(): void;
    public function producePartB(): void;
    public function producePartC(): void;
}

class ConcreteBuilder1 implements Builder
{
    private $product;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->product = new Product1();
    }

    public function producePartA(): void
    {
        $this->product->parts[] = "Part A1";
    }

    public function producePartB(): void
    {
        $this->product->parts[] = "Part B1";
    }

    public function producePartC(): void
    {
        $this->product->parts[] = "Part C1";
    }

    public function getProduct(): Product1 {
        $result = $this->product;
        $this->reset();

        return $result;
    }
}

class ConcreteBuilder2 implements Builder
{
    private $product;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->product = new Product2();
    }

    public function producePartA(): void
    {
        $this->product->parts[] = "Part A2";
    }

    public function producePartB(): void
    {
        $this->product->parts[] = "Part B2";
    }

    public function producePartC(): void
    {
        $this->product->parts[] = "Part C2";
    }

    public function getProduct(): Product2 {
        $result = $this->product;
        $this->reset();

        return $result;
    }
}

class Director
{
    private $builder;

    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function buildMinimalViableProduct(): void
    {
        $this->builder->producePartA();
    }

    public function buildFullFeaturedProduct(): void
    {
        $this->builder->producePartA();
        $this->builder->producePartB();
        $this->builder->producePartC();
    }
}

function clientCode(Director $director)
{
    $builder = new ConcreteBuilder1();
    $director->setBuilder($builder);

    echo "Standard basic product:\n";
    $director->buildMinimalViableProduct();
    $builder->getProduct()->listParts();

    echo "Standard full featured product:\n";
    $director->buildFullFeaturedProduct();
    $builder->getProduct()->listParts();

    // Remember, the Builder pattern can be used without a Director class.
    echo "Custom product:\n";
    $builder->producePartA();
    $builder->producePartC();
    $builder->getProduct()->listParts();
}

$director = new Director();
clientCode($director);


