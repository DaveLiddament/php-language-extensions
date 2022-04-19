<?php

declare(strict_types=1);

namespace FriendOnMethod;

use DaveLiddament\PhpLanguageExtensions\Friend;

class Person
{
    #[Friend(FriendUpdater::class)]
    public function updateName(): void
    {
    }

    public function update(): void
    {
        $this->updateName(); // OK: Method calls on same class is always allowed
    }
}

class Updater
{
    public function updater(Person $person): void
    {
        $person->updateName(); // ERROR: Updater is not a friend of Person::updateName
    }
}

$person = new Person();
$person->updateName(); // ERROR: Global namespace is not a friend of Person::updateName

class FriendUpdater
{
    public function update(): void
    {
        $person = new Person();
        $person->updateName(); // OK: FriendUpdater is a friend of Person::updateName
    }
}
