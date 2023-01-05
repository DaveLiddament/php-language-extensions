<?php

declare(strict_types=1);

namespace NamespaceVisibilityOnClassExcludeSubNamespaces {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;


    #[NamespaceVisibility(excludeSubNamespaces: true)]
    class Person
    {
        public function updateName(): void
        {
        }
    }

}


namespace NamespaceVisibilityOnClassExcludeSubNamespace\SubNamesapce {

    use NamespaceVisibilityOnClassExcludeSubNamespaces\Person;

    class AnotherClass
    {
        public function update(): void
        {
            $person = new Person();
            $person->updateName(); // ERROR: Call to Person::updateName in a sub namespace, where sub namespace is not allowed.
        }
    }
}
