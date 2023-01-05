<?php

namespace NamespaceVisibilityOnConstructor {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    class Person
    {
        #[NamespaceVisibility]
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
            return new Person(); // OK: Calls within the same namespace allowed.
        }
    }

    new Person(); // OK: Calls withing the same namespace allowed
}


namespace NamespaceVisibilityOnConstructor\SubNamespace {

    use NamespaceVisibilityOnConstructor\Person;

    class AnotherPersonBuilder
    {
        public function create(): void
        {
            new Person(); // OK, sub namespace of NamespaceVisibilityOnConstructor
        }
    }
}



namespace NamespaceVisibilityOnConstructor2 {

    use NamespaceVisibilityOnConstructor\Person;

    class Exam
    {
        public function addPerson(): void
        {
            new Person(); // ERROR: Call to Person::__construct has namespace visibility, this is a different namespace
        }
    }
}
