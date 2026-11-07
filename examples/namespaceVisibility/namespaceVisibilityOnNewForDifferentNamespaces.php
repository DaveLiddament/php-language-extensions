<?php

namespace NamespaceVisibilityOnNewForDifferentNamespaces {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    class Person
    {
        #[NamespaceVisibility(namespace: 'NamespaceVisibilityOnNewDifferentNamespace')]
        public function __construct()
        {
        }

    }
}


namespace NamespaceVisibilityOnNewDifferentNamespace {

    use NamespaceVisibilityOnNewForDifferentNamespaces\Person;

    class AnotherPersonBuilder
    {
        public function create(): void
        {
            new Person(); // OK: call to Person::__construct from allowed namespace.
        }
    }
}

namespace NamespaceVisibilityOnNewDifferentNamespace\SubNamespace {

    use NamespaceVisibilityOnNewForDifferentNamespaces\Person;

    class AnotherPersonBuilder
    {
        public function create(): void
        {
            new Person(); // OK: call to Person::__construct from sub namespace of allowed namespace.
        }
    }
}

namespace NamespaceVisibilityOnNewDifferentNamespace2 {

    use NamespaceVisibilityOnNewForDifferentNamespaces\Person;

    class AnotherPersonBuilder
    {
        public function create(): void
        {
            new Person(); // ERROR: call to Person::__construct from a namespace that is not allowed.
        }
    }
}
