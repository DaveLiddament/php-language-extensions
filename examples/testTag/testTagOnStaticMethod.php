<?php

namespace TestTagOnStaticMethod;


use DaveLiddament\PhpLanguageExtensions\TestTag;

class Person
{
    #[TestTag]
    public static function updateName(): void
    {
    }

    public static function update(): void
    {
        Person::updateName(); // ERROR: Person::updateName has TestTag, so can only be called from test code (even from within Person)
    }

    public static function updateSelf(): void
    {
        self::updateName(); // ERROR: Person::updateName has TestTag, so can only be called from test code (even from within Person)
    }
}

class Updater
{
    public function updater(): void
    {
        Person::updateName(); // ERROR: Person::updateName has TestTag, so can only be called from test code
    }
}

Person::updateName(); // ERROR: Person::updateName has TestTag, so can only be called from test code
