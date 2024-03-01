<?php

namespace TestTagOnConstructor;

use DaveLiddament\PhpLanguageExtensions\TestTag;

#[TestTag]
class Person
{
    public function __construct()
    {
    }

    public static function create(): Person // No Error, class can interact with itself
    {
        return new Person(); // No Error, class can interact with itself
    }
}

class PersonTest
{
    public function newInstance(): Person
    {
        return new Person(); // ERROR
    }

    public function buildPerson(): Person
    {
        return Person::create(); // ERROR
    }
}
