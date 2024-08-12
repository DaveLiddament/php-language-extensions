<?php

declare(strict_types=1);

namespace TestTagClassOnMethod;

use DaveLiddament\PhpLanguageExtensions\TestTag;

#[TestTag]
class Person
{
    public function updateName(): void
    {
    }

    public function update(): void
    {
        $this->updateName(); // OK - whole class is marked with TestTag, so OK to call methods within it.
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

