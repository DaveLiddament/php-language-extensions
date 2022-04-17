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
        Person::updateName(); // OK
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

class FriendUpdater
{
    public function update(): void
    {
        Person::updateName(); // OK
    }
}
