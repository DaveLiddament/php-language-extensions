<?php

namespace TestTagOnClassIgnoredInTestClass;

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

    public function aMethod(): void
    {
    }
}

class PersonTest
{
    public function newInstance(): Person
    {
        return new Person(); // OK, call from test class
    }

    public function buildPerson(): Person
    {
        return Person::create(); // OK, call from test class
    }

    public function aMethod(Person $person): void
    {
        $this->aMethod(); // OK, call from test class
    }
}
