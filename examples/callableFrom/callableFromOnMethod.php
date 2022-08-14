<?php

declare(strict_types=1);

namespace CallableFromOnMethod;

use DaveLiddament\PhpLanguageExtensions\CallableFrom;

class Person
{
    #[CallableFrom(CallableFromUpdater::class)]
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
        $person->updateName(); // ERROR: Updater is not a callableFrom of Person::updateName
    }
}

$person = new Person();
$person->updateName(); // ERROR: Global namespace is not a callableFrom of Person::updateName

class CallableFromUpdater
{
    public function update(): void
    {
        $person = new Person();
        $person->updateName(); // OK: CallableFromUpdater is a callableFrom of Person::updateName
    }
}
