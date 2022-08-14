<?php

declare(strict_types=1);

namespace MultipleCallableFroms;

use DaveLiddament\PhpLanguageExtensions\CallableFrom;

class Person
{
    #[CallableFrom(CallableFromUpdater::class, AnotherCallableFromUpdater::class)]
    public function updateName(): void
    {
    }
}

class CallableFromUpdater
{
    public function update(Person $person): void
    {
        $person->updateName(); // OK: CallableFromUpdater a callableFrom of Person::updateName
    }
}

class AnotherCallableFromUpdater
{
    public function update(Person $person): void
    {
        $person->updateName(); // OK: AnotherCallableFromUpdater a callableFrom of Person::updateName
    }
}
