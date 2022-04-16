<?php

namespace PackageOnConstructor {

    use DaveLiddament\PhpstanPhpLanguageExtensions\Attributes\Package;

    class Person
    {
        #[Package]
        public function __construct()
        {
        }

        public static function create(): Person
        {
            return new Person(); // OK
        }
    }

    class PersonBuilder
    {
        public function build(): Person
        {
            return new Person(); // OK
        }
    }

    new Person(); // OK
}

namespace PackageOnConstructor2 {

    use PackageOnConstructor\Person;

    class Exam
    {
        public function addPerson(): void
        {
            new Person(); // ERROR
        }
    }
}
