/**
 * [Javascript] Factory Method pattern.
 * 
 * usage: node Design-Pattern/01-FactoryMethod/js-example-01.js
 */

// Concrete Product 1: Car
class Car {
    constructor(name = "Car Default Name") {
        this.name = name;
    }

    delivery = () => {
        console.log("Delivery by Car.");
    }
}

// Concrete Product 2: Ship
class Ship {
    constructor(name = "Ship Default Name") {
        this.name = name;
    }

    delivery = () => {
        console.log("Delivery by Ship.");
    }
}

// Creator
class ServiceLogistic {
    getTransport = () => {};
    handle = () => {
        const transport = this.getTransport();
        transport.delivery();
    }
}

// Concrete Creator 1: RoadServiceLogistic
class RoadServiceLogistic extends ServiceLogistic {
    getTransport = () => new Car();
}

// Concrete Creator 2: ShipServiceLogistic
class ShipServiceLogistic extends ServiceLogistic {
    getTransport = () => new Ship();
}

// Application
class Application {
    factory = null;

    constructor(logistic = 'road') {
        if (logistic === 'road') {
            this.factory = new RoadServiceLogistic();
        } else if (logistic === 'ship') {
            this.factory = new ShipServiceLogistic();
        } else {
            console.log("Have not this transport.");
        }
    }

    init = () => {
        this.factory.handle();
    }
}

// Client code.
const app1 = new Application();
app1.init();

const app2 = new Application('ship');
app2.init();