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
        return new Person(); // ERROR
    }

    public static function createSelf(): self
    {
        return new self(); // ERROR
    }
}

class AnotherClass
{
    public function buildPerson(): Person
    {
        return new Person(); // ERROR
    }
}
