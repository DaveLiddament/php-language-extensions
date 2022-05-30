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
        Person::updateName(); // ERROR
    }

    public static function updateSelf(): void
    {
        self::updateName(); // ERROR
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
