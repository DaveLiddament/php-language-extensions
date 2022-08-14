<?php

namespace CallableFromOnConstructor;

use DaveLiddament\PhpLanguageExtensions\CallableFrom;

class Person
{
    #[CallableFrom(PersonBuilder::class)]
    public function __construct()
    {
    }

    public static function create(): Person
    {
        return new Person(); // OK: Method calls on same class always allowed.
    }
}

class Exam
{
    public function addPerson(): void
    {
        new Person(); // ERROR: Exam is not a CallableFrom of Person::__construct
    }
}

new Person(); // ERROR

class PersonBuilder
{
    public function build(): Person
    {
        return new Person(); // OK: PersonBuilder is a callableFrom of Person::__construct
    }
}
