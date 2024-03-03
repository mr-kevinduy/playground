/**
 * [Javascript] Factory Method pattern.
 * 
 * usage: node Design-Pattern/01-FactoryMethod/js-example-02.js
 */

// Concrete Product 1
class Car {
    constructor({ name = "Car Name", price = "$1.00", customerInfo = {} }) {
        this.name = name;
        this.price = price;
        this.customerInfo = customerInfo;
    }
}

// Concrete Product 2
class Ship {
    constructor({ name = "Ship Name", price = "$2.00", customerInfo = {} }) {
        this.name = name;
        this.price = price;
        this.customerInfo = customerInfo;
    }
}

// Creator and with default Concrete Creator
class ServiceLogistics {
    constructor(obj = Car) {
        this.transport = obj; // Factory Method: with default product is Car.
    }

    getTransport = (info) => {
        return new this.transport(info);
    }
}

// Application and Client code.
const carService = new ServiceLogistics();
const transportByCar = carService.getTransport({ customerInfo: { name: "Customer Name 001", age: 18 } });
console.log("CarService: ", transportByCar);


const shipService = new ServiceLogistics(Ship);
const transportByShip = shipService.getTransport({ customerInfo: { name: "Customer Name 002", age: 33 } });
console.log("ShipService: ", transportByShip);