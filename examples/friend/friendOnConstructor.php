<?php

namespace FriendOnConstructor;

use DaveLiddament\PhpstanPhpLanguageExtensions\Attributes\Friend;

class Person
{
    #[Friend(PersonBuilder::class)]
    public function __construct()
    {
    }

    public static function create(): Person
    {
        return new Person(); // OK
    }
}

class Exam
{
    public function addPerson(): void
    {
        new Person(); // ERROR
    }
}

new Person(); // ERROR

class PersonBuilder
{
    public function build(): Person
    {
        return new Person(); // OK
    }
}
