<?php

declare(strict_types=1);

namespace FriendRulesIgnoredForTestClass;

use DaveLiddament\PhpstanPhpLanguageExtensions\Attributes\Friend;


#[Friend(FriendUpdater::class)]
class Person
{
    public function updateName(): void
    {
    }
}

class FriendUpdater
{
}

class PersonTest
{
    public function updater(Person $person): void
    {
        $person->updateName(); // OK calling from a class with a name ending Test
    }
}
