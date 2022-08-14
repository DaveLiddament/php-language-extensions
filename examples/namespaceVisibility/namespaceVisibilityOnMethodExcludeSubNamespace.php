<?php

declare(strict_types=1);

namespace NamespaceVisibilityOnMethodExcludeSubNamespace {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    class Person
    {
        #[NamespaceVisibility(excludeSubNamespaces: true)]
        public function updateName(): void
        {
        }

        public function update(): void
        {
            $this->updateName(); // OK
        }
    }
}



namespace NamespaceVisibilityOnMethodExluceSubNamespace\SubNamespace {

    use NamespaceVisibilityOnMethodExcludeSubNamespace\Person;
    class AnotherPersonUpdater
    {
        public function update(Person $person): void
        {
            $person->updateName(); // ERROR - Subnamespace of NamespaceVisibilityOnMethod, which is not allowed
        }
    }
}

