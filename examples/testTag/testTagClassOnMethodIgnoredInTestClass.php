<?php

declare(strict_types=1);

namespace TestTagClassOnMethodIgnoredInTestClass;

use DaveLiddament\PhpLanguageExtensions\TestTag;

#[TestTag]
class Person
{
    public function updateName(): void
    {
    }
}

class PersonTest
{
    public function updater(Person $person): void
    {
        $person->updateName(); // OK - Called from Test class
    }
}


