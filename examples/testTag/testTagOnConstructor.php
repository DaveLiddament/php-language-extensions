<?php

namespace TestTagOnConstructor;

use DaveLiddament\PhpLanguageExtensions\TestTag;

class Person
{
    #[TestTag]
    public function __construct()
    {
    }

    public static function create(): Person
    {
        return new Person(); // ERROR: Person::__construct has TestTag, so can only be called from test code (even from within Person)
    }

    public static function createSelf(): self
    {
        return new self(); // ERROR: Person::__construct has TestTag, so can only be called from test code (even from within Person)
    }
}

class AnotherClass
{
    public function buildPerson(): Person
    {
        return new Person(); // ERROR: Person::__construct has TestTag, so can only be called from test code
    }
}
