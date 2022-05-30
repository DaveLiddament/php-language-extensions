<?php

namespace TestTagOnConstructorIgnoredInTestClass;

use DaveLiddament\PhpLanguageExtensions\TestTag;

class Person
{
    #[TestTag]
    public function __construct()
    {
    }
}

class PersonTest
{
    public function buildPerson(): Person
    {
        return new Person(); // OK TetTag called from a test class
    }
}
