<?php

namespace NamespaceVisibilityOnNew {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    #[NamespaceVisibility]
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
            return new Person(); // OK: Calls within the same namespace allowed.
        }
    }

    new Person(); // OK: Calls within the same namespace allowed.
}

namespace NamespaceVisibilityOnNew\SubNamespace {

    use NamespaceVisibilityOnNew\Person;

    class AnotherBuilder {

        public function build(): Person
        {
            return new Person(); // OK: sub namespace of NamespaceVisibilityOnNew
        }
    }
}

namespace NamespaceVisibilityOnNew2 {

    use NamespaceVisibilityOnNew\Person;

    class Exam
    {
        public function addPerson(): void
        {
            new Person(); // ERROR: Person has namespace visibility, this is a different namespace
        }
    }
}
