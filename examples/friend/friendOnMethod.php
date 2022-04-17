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
        $this->updateName(); // OK
    }
}

class Updater
{
    public function updater(Person $person): void
    {
        $person->updateName(); // ERROR
    }
}

$person = new Person();
$person->updateName(); // ERROR

class FriendUpdater
{
    public function update(): void
    {
        $person = new Person();
        $person->updateName(); // OK
    }
}
