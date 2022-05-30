<?php

declare(strict_types=1);

namespace TestTagOnMethodIgnoredInTestClass;

use DaveLiddament\PhpLanguageExtensions\TestTag;

class Person
{
    #[TestTag]
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


