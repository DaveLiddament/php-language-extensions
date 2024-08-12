<?php

namespace TestTagClassOnStaticMethodIgnoredInTestClass;


use DaveLiddament\PhpLanguageExtensions\TestTag;

#[TestTag]
class Person
{
    public static function updateName(): void
    {
    }
}

class PersonTest
{
    public function updater(): void
    {
        Person::updateName(); // OK - Called from a test class
    }
}
