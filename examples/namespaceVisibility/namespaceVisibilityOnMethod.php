<?php

declare(strict_types=1);

namespace NamespaceVisibilityOnMethod {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    class Person
    {
        #[NamespaceVisibility]
        public function updateName(): void
        {
        }

        public function update(): void
        {
            $this->updateName(); // OK: Calls to same class allowed
        }
    }

    class Updater
    {
        public function updater(Person $person): void
        {
            $person->updateName(); // OK: Calls within same namespace allowed
        }
    }

    $person = new Person();
    $person->updateName(); // OK: Calls within same namespace allowed
}



namespace NamespaceVisibilityOnMethod\SubNamespace {

    use NamespaceVisibilityOnMethod\Person;
    class AnotherPersonUpdater
    {
        public function update(Person $person): void
        {
            $person->updateName(); // OK - Subnamespace of NamespaceVisibilityOnMethod, which is allowed
        }
    }
}


namespace NamespaceVisibilityOnMethod2 {

    use NamespaceVisibilityOnMethod\Person;

    class AnotherUpdater
    {
        public function update(): void
        {
            $person = new Person();
            $person->updateName(); // ERROR: Call to Person::updateName which has namespaceVisibility visibility
        }
    }
}
