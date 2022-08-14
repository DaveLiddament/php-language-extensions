<?php

declare(strict_types=1);

namespace CallableFromRulesIgnoredForTestClass;

use DaveLiddament\PhpLanguageExtensions\CallableFrom;


#[CallableFrom(CallableFromUpdater::class)]
class Person
{
    public function updateName(): void
    {
    }
}

class CallableFromUpdater
{
}

class PersonTest
{
    public function updater(Person $person): void
    {
        $person->updateName(); // OK: calling from a class with a name ending Test
    }
}
