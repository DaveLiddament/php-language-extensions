<?php

declare(strict_types=1);

namespace FriendOnClass;

use DaveLiddament\PhpLanguageExtensions\Friend;


#[Friend(FriendUpdater::class)]
class Person
{
    public function updateName(): void
    {
    }

    public function update(): void
    {
        $this->updateName(); // OK: Method calls on same class are always allowed
    }
}

class Updater
{
    public function updater(Person $person): void
    {
        $person->updateName(); // ERROR: Updater is not a Friend of Person
    }
}

$person = new Person();
$person->updateName(); // ERROR: Global namespace is not a Friend of Person

class FriendUpdater
{
    public function update(): void
    {
        $person = new Person();
        $person->updateName(); // OK: FriendUpdater is a Friend of Person
    }
}
