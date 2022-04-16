<?php

declare(strict_types=1);

namespace MultipleFriends;

use DaveLiddament\PhpstanPhpLanguageExtensions\Attributes\Friend;

class Person
{
    #[Friend([FriendUpdater::class, AnotherFriendUpdater::class])]
    public function updateName(): void
    {
    }
}

class FriendUpdater
{
    public function update(Person $person): void
    {
        $person->updateName(); // OK
    }
}

class AnotherFriendUpdater
{
    public function update(Person $person): void
    {
        $person->updateName(); // OK
    }
}
