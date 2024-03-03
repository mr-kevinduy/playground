# Abstract Factory Pattern
***Design Patterns > Creational Patterns > Abstract Factory Pattern***

# Khả năng ứng dụng

# Ưu điểm

# Nhược điểm

# Struct
<<interface>>AbstractFactory
    - createProductA(): ProductA
    - createProductB(): ProductB
    - createProductC(): ProductC

Factory1: AbstractFactory
    - createProductA(): ProductA
        => new ProductA1
    - createProductB(): ProductB
        => new ProductB1
    - createProductC(): ProductC
        => new ProductC1

Factory2: AbstractFactory
    - createProductA(): ProductA
        => new ProductA2
    - createProductB(): ProductB
        => new ProductB2
    - createProductC(): ProductC
        => new ProductC2

<<interface>> ProductA
<<interface>> ProductB
<<interface>> ProductC

ProductA1: ProductA
ProductB1: ProductB
ProductC1: ProductC

ProductA2: ProductA
ProductB2: ProductB
ProductC2: ProductC

Aplication($factory)
    $pA = $factory->createProductA();
    $pB = $factory->createProductB();
    $pC = $factory->createProductC();