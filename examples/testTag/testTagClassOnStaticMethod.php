<?php

namespace TestTagClassOnStaticMethod;


use DaveLiddament\PhpLanguageExtensions\TestTag;

#[TestTag]
class Person
{
    public static function updateName(): void
    {
    }

    public static function update(): void
    {
        Person::updateName(); // OK - whole class is marked with TestTag, so OK to call methods within it.
    }

    public static function updateSelf(): void
    {
        self::updateName(); // OK - whole class is marked with TestTag, so OK to call methods within it.
    }
}

class Updater
{
    public function updater(): void
    {
        Person::updateName(); // ERROR
    }
}

Person::updateName(); // ERROR
