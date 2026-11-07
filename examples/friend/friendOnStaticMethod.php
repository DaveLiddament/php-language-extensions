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
        self::updateName(); // OK: Method calls within class allowed
    }
}

class Updater
{
    public function updater(): void
    {
        Person::updateName(); // ERROR: Updater is not a friend of Person::updateName
    }
}

Person::updateName(); // ERROR: Global namespace is not a friend of Person::updateName

class FriendUpdater
{
    public function update(): void
    {
        Person::updateName(); // OK: FriendUpdater is a friend of Person::updateName
    }
}
