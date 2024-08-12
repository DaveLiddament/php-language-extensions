<?php

namespace TestTagOnClass;

use DaveLiddament\PhpLanguageExtensions\TestTag;

#[TestTag]
class Person
{
    public function __construct()
    {
    }

    public static function create(): Person // OK, class can interact with itself
    {
        return new Person(); // OK, class can interact with itself
    }

    public function aMethod(int $number): void
    {
        if ($number > 0) {
            $this->aMethod($number - 1); // OK, class can interact with itself
        }
    }
}

class AnotherClass
{
    public function newInstance(): Person
    {
        return new Person(); // ERROR
    }

    public function buildPerson(): Person
    {
        return Person::create(); // ERROR
    }

    public function aMethod(Person $person): void
    {
        $person->aMethod(1); // ERROR
    }
}
