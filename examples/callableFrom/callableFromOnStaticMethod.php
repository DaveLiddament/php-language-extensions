<?php

namespace CallableFromOnStaticMethod;

use DaveLiddament\PhpLanguageExtensions\CallableFrom;

class Person
{
    #[CallableFrom(CallableFromUpdater::class)]
    public static function updateName(): void
    {
    }

    public static function update(): void
    {
        Person::updateName(); // OK: Method calls within class allowed
    }
}

class Updater
{
    public function updater(): void
    {
        Person::updateName(); // ERROR: Updater is not a callableFrom of Person::updateName
    }
}

Person::updateName(); // ERROR

class CallableFromUpdater
{
    public function update(): void
    {
        Person::updateName(); // OK: CallableFromUpdater is a callableFrom of Person::updateName
    }
}
