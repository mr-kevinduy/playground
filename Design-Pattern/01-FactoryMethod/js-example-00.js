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
var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var ConcreteProduct1 = /** @class */ (function () {
    function ConcreteProduct1() {
    }
    ConcreteProduct1.prototype.operation = function () {
        return '{Result of the ConcreteProduct1}';
    };
    return ConcreteProduct1;
}());
var ConcreteProduct2 = /** @class */ (function () {
    function ConcreteProduct2() {
    }
    ConcreteProduct2.prototype.operation = function () {
        return '{Result of the ConcreteProduct2}';
    };
    return ConcreteProduct2;
}());
var Creator = /** @class */ (function () {
    function Creator() {
    }
    Creator.prototype.someOperation = function () {
        var product = this.factoryMethod();
        return "Creator: The same creator's code has just worked with ".concat(product.operation());
    };
    return Creator;
}());
var ConcreteCreator1 = /** @class */ (function (_super) {
    __extends(ConcreteCreator1, _super);
    function ConcreteCreator1() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ConcreteCreator1.prototype.factoryMethod = function () {
        return new ConcreteProduct1();
    };
    return ConcreteCreator1;
}(Creator));
var ConcreteCreator2 = /** @class */ (function (_super) {
    __extends(ConcreteCreator2, _super);
    function ConcreteCreator2() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ConcreteCreator2.prototype.factoryMethod = function () {
        return new ConcreteProduct2();
    };
    return ConcreteCreator2;
}(Creator));
// Application
var App = /** @class */ (function () {
    function App(config) {
        this.creatorName = null;
        this.creatorName = config.creator;
    }
    App.prototype.make = function () {
        if (!this.creatorName && this.creatorName === 'creator1') {
            return new ConcreteCreator1;
        }
        else if (this.creatorName === 'creator2') {
            return new ConcreteCreator2();
        }
        return new ConcreteCreator1();
    };
    return App;
}());
var config = { creator: 'creator2' };
var app = new App(config);
// Client code
var creator = app.make();
console.log('Client:');
console.log(creator.someOperation());
