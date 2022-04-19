<?php

namespace PackageOnConstructor {

    use DaveLiddament\PhpLanguageExtensions\Package;

    class Person
    {
        #[Package]
        public function __construct()
        {
        }

        public static function create(): Person
        {
            return new Person(); // OK: Calls to same class allowed.
        }
    }

    class PersonBuilder
    {
        public function build(): Person
        {
            return new Person(); // OK: Calls within the same package allowed.
        }
    }

    new Person(); // OK: Calls withing the same package allowed
}

namespace PackageOnConstructor2 {

    use PackageOnConstructor\Person;

    class Exam
    {
        public function addPerson(): void
        {
            new Person(); // ERROR: Call to Person::__construct has package visibility
        }
    }
}
