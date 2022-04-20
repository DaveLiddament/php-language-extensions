<?php

declare(strict_types=1);

namespace MultipleFriends;

use DaveLiddament\PhpLanguageExtensions\Friend;

class Person
{
    #[Friend(FriendUpdater::class, AnotherFriendUpdater::class)]
    public function updateName(): void
    {
    }
}

class FriendUpdater
{
    public function update(Person $person): void
    {
        $person->updateName(); // OK: FriendUpdater a friend of Person::updateName
    }
}

class AnotherFriendUpdater
{
    public function update(Person $person): void
    {
        $person->updateName(); // OK: AnotherFriendUpdater a friend of Person::updateName
    }
}
