<?php

namespace PackageOnNew {

    use DaveLiddament\PhpLanguageExtensions\Package;

    #[Package]
    class Person
    {
        public static function create(): Person
        {
            return new Person(); // OK: Calls to same class allowed.
        }

        public static function createSelf(): self
        {
            return new self(); // OK: Calls to same class allowed.
        }
    }

    class PersonBuilder
    {
        public function build(): Person
        {
            return new Person(); // OK: Calls within the same package allowed.
        }
    }

    new Person(); // OK: Calls within the same package allowed.
}

namespace PackageOnNew2 {

    use PackageOnNew\Person;

    class Exam
    {
        public function addPerson(): void
        {
            new Person(); // ERROR: Person has package visibility
        }
    }
}
