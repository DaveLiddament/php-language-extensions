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
        $this->updateName(); // ERROR
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

