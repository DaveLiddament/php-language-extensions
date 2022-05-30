<?php

namespace TestTagOnStaticMethodIgnoredInTestClass;


use DaveLiddament\PhpLanguageExtensions\TestTag;

class Person
{
    #[TestTag]
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
