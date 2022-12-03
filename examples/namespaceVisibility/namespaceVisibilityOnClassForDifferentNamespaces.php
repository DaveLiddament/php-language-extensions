<?php

declare(strict_types=1);

namespace NamespaceVisibilityOnClassForDifferentNamespaces {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;


    #[NamespaceVisibility(namespace: 'NamespaceVisibilityOnClassDifferentNamespace')]
    class Person
    {
        public function updateName(): void
        {
        }
    }

}


namespace NamespaceVisibilityOnClassDifferentNamespace {

    use NamespaceVisibilityOnClassForDifferentNamespaces\Person;

    class AnotherClass
    {
        public function update(): void
        {
            $person = new Person();
            $person->updateName(); // OK: Call to Person::updateName is in the allowed namespace.
        }
    }
}
