<?php

namespace NamespaceVisibilityOnConstructorForDifferentNamespaces {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    class Person
    {
        #[NamespaceVisibility(namespace: 'NamespaceVisibilityOnConstructorDifferentNamespace')]
        public function __construct()
        {
        }

    }
}


namespace NamespaceVisibilityOnConstructorDifferentNamespace {

    use NamespaceVisibilityOnConstructorForDifferentNamespaces\Person;

    class AnotherPersonBuilder
    {
        public function create(): void
        {
            new Person(); // OK, called to Person::__construct from allowed namespace.
        }
    }
}

