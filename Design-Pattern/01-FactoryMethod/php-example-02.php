<?php

/**
 * Method Factory Example
 */

// Creator
abstract class AbstractFactoryMethod
{
    abstract function makePHPBook($param);
}

// Concrete Creator 1
class OReillyFactoryMethod extends AbstractFactoryMethod
{
    private $context = 'OReilly';

    function makePHPBook($param)
    {
        $book = null;
        switch ($param) {
            case 'us':
                $book = new OReillyPHPBook;
                break;
            case 'other':
                $book = new SamsPHPBook;
                break;
            default:
                $book = new OReillyPHPBook;
                break;
        }

        return $book;
    }
}

// Concrete Creator 2
class SamsFactoryMethod extends AbstractFactoryMethod
{
    private $context = "Sams";

    function makePHPBook($param)
    {
        $book = null;
        switch ($param) {
            case "us":
                $book = new SamsPHPBook;
                break;      
            case "other":
                $book = new OReillyPHPBook;
                break;
            case "otherother":
                $book = new VisualQuickstartPHPBook;
                break;
            default:
                $book = new SamsPHPBook;
                break;    
        }   

        return $book;
    }
}

// Abstract Product
abstract class AbstractBook
{
    abstract function getAuthor();
    abstract function getTitle();
}

// Product 1
abstract class AbstractPHPBook extends AbstractBook
{
    private $subject = "PHP";
}

// Concrete Product 1-1
class OReillyPHPBook extends AbstractPHPBook
{
    private $author;
    private $title;
    private static $oddOrEven = 'odd';

    function __construct() {
        //alternate between 2 books
        if ('odd' == self::$oddOrEven) {
            $this->author = 'Rasmus Lerdorf and Kevin Tatroe';
            $this->title  = 'Programming PHP';
            self::$oddOrEven = 'even';
        } else {
            $this->author = 'David Sklar and Adam Trachtenberg';
            $this->title  = 'PHP Cookbook'; 
            self::$oddOrEven = 'odd';
        }  
    }

    function getAuthor()
    {
        return $this->author;
    }

    function getTitle()
    {
        return $this->title;
    }
}

// Concrete Product 1-2
class SamsPHPBook extends AbstractPHPBook
{
    private $author;
    private $title;

    function __construct()
    {
        //alternate randomly between 2 books
        mt_srand((double)microtime()*10000000);
        $rand_num = mt_rand(0,1);      
 
        if (1 > $rand_num) {
            $this->author = 'George Schlossnagle';
            $this->title  = 'Advanced PHP Programming';
        } else {
            $this->author = 'Christian Wenz';
            $this->title  = 'PHP Phrasebook'; 
        }  
    }

    function getAuthor()
    {
        return $this->author;
    }

    function getTitle()
    {
        return $this->title;
    }
}

// Concrete Product 1-3
class VisualQuickstartPHPBook extends AbstractPHPBook
{
    private $author;
    private $title;

    function __construct()
    {
        $this->author = 'Larry Ullman';
        $this->title  = 'PHP for the World Wide Web';
    }

    function getAuthor()
    {
        return $this->author;
    }

    function getTitle()
    {
        return $this->title;
    }
}

writeln('START TESTING FACTORY METHOD PATTERN');
writeln('');

writeln('testing OReillyFactoryMethod');
$factoryMethodInstance = new OReillyFactoryMethod;
testFactoryMethod($factoryMethodInstance);
writeln('');

writeln('testing SamsFactoryMethod');
$factoryMethodInstance = new SamsFactoryMethod;
testFactoryMethod($factoryMethodInstance);
writeln('');

writeln('END TESTING FACTORY METHOD PATTERN');
writeln('');

function testFactoryMethod($factoryMethodInstance)
{
    $phpUs = $factoryMethodInstance->makePHPBook("us");
    writeln('us php Author: '.$phpUs->getAuthor());
    writeln('us php Title: '.$phpUs->getTitle());

    $phpUs = $factoryMethodInstance->makePHPBook("other");
    writeln('other php Author: '.$phpUs->getAuthor());
    writeln('other php Title: '.$phpUs->getTitle());

    $phpUs = $factoryMethodInstance->makePHPBook("otherother");
    writeln('otherother php Author: '.$phpUs->getAuthor());
    writeln('otherother php Title: '.$phpUs->getTitle());
}

function writeln($line_in)
{
    echo $line_in."\n";
}