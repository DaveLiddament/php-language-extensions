<?php

namespace NamespaceVisibilityOnNewExcludeSubNamespaces {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    #[NamespaceVisibility(excludeSubNamespaces: true)]
    class Person
    {
    }
}

namespace NamespaceVisibilityOnNewExcludeSubNamespaces\SubNamespace {

    use NamespaceVisibilityOnNewExcludeSubNamespaces\Person;

    class PersonFactory
    {
        public function createPerson(): Person
        {
            return new Person(); // ERROR: sub namespace of NamespaceVisibilityOnNewExcludeSubNamespaces, where sub namespace is not allowed
        }
    }
}
