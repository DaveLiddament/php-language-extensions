<?php

declare(strict_types=1);

namespace CallableFromOnClass;

use DaveLiddament\PhpLanguageExtensions\CallableFrom;


#[CallableFrom(CallableFromUpdater::class)]
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
        $person->updateName(); // ERROR: Updater is not a CallableFrom of Person
    }
}

$person = new Person();
$person->updateName(); // ERROR

class CallableFromUpdater
{
    public function update(): void
    {
        $person = new Person();
        $person->updateName(); // OK
    }
}
