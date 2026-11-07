<?php

namespace NamespaceVisibilityOnConstructorExcludeSubNamespaces {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    class Person
    {
        #[NamespaceVisibility(excludeSubNamespaces: true)]
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


namespace NamespaceVisibilityOnConstructorExcludeSubNamespaces\SubNamespace {

    use NamespaceVisibilityOnConstructorExcludeSubNamespaces\Person;

    class AnotherPersonBuilder
    {
        public function create(): void
        {
            new Person(); // ERROR: sub namespace of NamespaceVisibilityOnConstructorExcludeSubNamespaces, where sub namespace is not allowed
        }
    }
}

