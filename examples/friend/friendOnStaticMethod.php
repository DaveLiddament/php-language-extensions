<?php

namespace FriendOnStaticMethod;

use DaveLiddament\PhpLanguageExtensions\Friend;

class Person
{
    #[Friend(FriendUpdater::class)]
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
        Person::updateName(); // ERROR: Updater is not a friend of Person::updateName
    }
}

Person::updateName(); // ERROR

class FriendUpdater
{
    public function update(): void
    {
        Person::updateName(); // OK: FriendUpdater is a friend of Person::updateName
    }
}
