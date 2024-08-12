<?php

namespace TestTagClassOnConstructorIgnoredInTestClass;

use DaveLiddament\PhpLanguageExtensions\TestTag;

#[TestTag]
class Person
{
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
