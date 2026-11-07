<?php

declare(strict_types=1);

namespace TestTagOnMethod;

use DaveLiddament\PhpLanguageExtensions\TestTag;

class Person
{
    #[TestTag]
    public function updateName(): void
    {
    }

    public function update(): void
    {
        $this->updateName(); // ERROR: Person::updateName has TestTag, so can only be called from test code (even from within Person)
    }
}

class Updater
{
    public function updater(Person $person): void
    {
        $person->updateName(); // ERROR: Person::updateName has TestTag, so can only be called from test code
    }
}

$person = new Person();
$person->updateName(); // ERROR: Person::updateName has TestTag, so can only be called from test code

