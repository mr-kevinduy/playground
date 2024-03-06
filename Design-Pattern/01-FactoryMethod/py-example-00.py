"""
Example 00: Conceptual Example

- Creator: ConcreteCreator1, ConcreteCreator2
- Product: ConcreteProduct1, ConcreteProduct2

- Python 3
- Usage: python Design-Pattern/01-FactoryMethod/py-example-00.py
"""

from abc import abstractmethod

class Product():
    @abstractmethod
    def operation(self) -> str:
        pass

class ConcreteProduct1(Product):
    def operation(self) -> str:
        return "{Result of the ConcreteProduct1}"
    
class ConcreteProduct2(Product):
    def operation(self) -> str:
        return "{Result of the ConcreteProduct2}"
    
class Creator():
    def factory_method(self):
        pass

    def some_operation(self) -> str:
        product = self.factory_method()
        result = f"Creator: {product.operation()}"

        return result

class ConcreteCreator1(Creator):
    def factory_method(self) -> Product:
        return ConcreteProduct1()
    
class ConcreteCreator2(Creator):
    def factory_method(self) -> Product:
        return ConcreteProduct2()

def client_code(creator: Creator) -> None:
    print(f"Client: Process with {creator.some_operation()}")

if __name__ == "__main__":
    print("App: ConcreteProduct1.")
    client_code(ConcreteCreator1())

    print("\n")

    print("App: ConcreteProduct2.")
    client_code(ConcreteCreator2())