<?php

namespace FriendOnNew;

use DaveLiddament\PhpLanguageExtensions\Friend;

#[Friend(PersonBuilder::class)]
class Person
{
    public static function create(): Person
    {
        return new Person(); // OK: Creating an instance from within the same class is always allowed
    }
}

class Exam
{
    public function addPerson(): void
    {
        new Person(); // ERROR: Exam is not a Friend of Person
    }
}

new Person(); // ERROR: Global namespace is not a Friend of Person

class PersonBuilder
{
    public function build(): Person
    {
        return new Person(); // OK: PersonBuilder is a Friend of Person
    }
}
