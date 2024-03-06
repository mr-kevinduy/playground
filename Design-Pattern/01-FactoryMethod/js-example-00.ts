/**
 * Example 00: Conceptual Example
 * 
 * - Creator
 * - ConcreteCreator: ConcreteCreator1, ConcreteCreator2
 * - Product: ConcreteProduct1, ConcreteProduct2
 * - Application && Clien code
 * 
 * Usage:
 * - Require: npm install -g typescript
 * - Compile: tsc Design-Pattern/01-FactoryMethod/js-example-00.ts
 * - Run: node Design-Pattern/01-FactoryMethod/js-example-00.js
 */

interface Product {
    operation(): string;
}

class ConcreteProduct1 implements Product {
    public operation(): string {
        return '{Result of the ConcreteProduct1}';
    }
}

class ConcreteProduct2 implements Product {
    public operation(): string {
        return '{Result of the ConcreteProduct2}';
    }
}

abstract class Creator {
    public abstract factoryMethod(): Product;

    public someOperation(): string {
        const product = this.factoryMethod();

        return `Creator: The same creator's code has just worked with ${product.operation()}`;
    }
}

class ConcreteCreator1 extends Creator {
    public factoryMethod(): Product {
        return new ConcreteProduct1();
    }
}

class ConcreteCreator2 extends Creator {
    public factoryMethod(): Product {
        return new ConcreteProduct2();
    }
}

// Application
class App {
    creatorName = null;

    constructor(config) {
        this.creatorName = config.creator;
    }

    make(): Creator {
        if (! this.creatorName && this.creatorName === 'creator1') {
            return new ConcreteCreator1;
        } else if (this.creatorName === 'creator2') {
            return new ConcreteCreator2();
        }

        return new ConcreteCreator1();
    }
}

const config = { creator: 'creator2' };
const app = new App(config);

// Client code
const creator = app.make();
console.log('Client:');
console.log(creator.someOperation());