<?php

declare(strict_types=1);

namespace NamespaceVisibilityOnClass {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;


    #[NamespaceVisibility]
    class Person
    {
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


namespace NamespaceVisibilityOnClass\SubNamesapce {

    use NamespaceVisibilityOnClass\Person;

    class AnotherClass
    {
        public function update(): void
        {
            $person = new Person();
            $person->updateName(); // OK: Calls within the same subnamespace allowed.
        }
    }
}


namespace NamespaceVisibilityOnClass2 {

    use NamespaceVisibilityOnClass\Person;

    class AnotherUpdater
    {
        public function update(): void
        {
            $person = new Person();
            $person->updateName(); // ERROR: Call to Person::update method which has namespace visibility.
        }
    }
}
