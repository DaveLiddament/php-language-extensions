<?php

namespace FriendOnConstructor;

use DaveLiddament\PhpLanguageExtensions\Friend;

class Person
{
    #[Friend(PersonBuilder::class)]
    public function __construct()
    {
    }

    public static function create(): Person
    {
        return new Person(); // OK: Method calls on same class always allowed.
    }

    public static function createSelf(): self
    {
        return new self(); // OK: Method calls on same class always allowed.
    }
}

class Exam
{
    public function addPerson(): void
    {
        new Person(); // ERROR: Exam is not a Friend of Person::__construct
    }
}

new Person(); // ERROR: Global namespace is not a Friend of Person::__construct

class PersonBuilder
{
    public function build(): Person
    {
        return new Person(); // OK: PersonBuilder is a friend of Person::__construct
    }
}
