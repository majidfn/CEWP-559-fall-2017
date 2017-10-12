<?php

// Sample from: http://php.net/manual/en/language.oop5.inheritance.php

class Foo
{
    public function printItem($string)
    {
        echo 'Foo: ' . $string . PHP_EOL;
    }
    
    public function printPHP()
    {
        echo 'PHP is great.' . PHP_EOL;
    }
    
    public function printHello(){
        echo 'Hello!';
    }
}

class Bar extends Foo
{
    public function printItem($string)
    {
        echo 'Bar: ' . $string . PHP_EOL;
    }
    
    public function printHello() {
        parent::printHello();
        echo 'Bar!' . PHP_EOL;
        
    }
}

$foo = new Foo();
$bar = new Bar();
$foo->printItem('baz'); // Output: 'Foo: baz'
$foo->printPHP();       // Output: 'PHP is great'
$foo->printHello();     // Output: 'Hello!'
$bar->printItem('baz'); // Output: 'Bar: baz'
$bar->printPHP();       // Output: 'PHP is great'
$bar->printHello();     // Output: 'Hello!Bar!'