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
