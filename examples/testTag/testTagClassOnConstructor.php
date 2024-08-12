<?php

namespace TestTagClassOnConstructor;

use DaveLiddament\PhpLanguageExtensions\TestTag;

#[TestTag]
class Person
{
    public function __construct()
    {
    }

    public static function create(): Person
    {
        return new Person(); // OK - whole class is marked with TestTag, so OK to call methods within it.
    }

    public static function createSelf(): self
    {
        return new self(); // OK - whole class is marked with TestTag, so OK to call methods within it.
    }
}

class AnotherClass
{
    public function buildPerson(): Person
    {
        return new Person(); // ERROR
    }
}
