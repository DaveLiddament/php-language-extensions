<?php

declare(strict_types=1);

namespace PackageOnClass {

    use DaveLiddament\PhpLanguageExtensions\Package;


    #[Package]
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
            $person->updateName(); // OK: Calls within same package allowed
        }
    }

    $person = new Person();
    $person->updateName(); // OK: Calls within same package allowed

}


namespace PackageOnClass2 {

    use PackageOnClass\Person;

    class AnotherUpdater
    {
        public function update(): void
        {
            $person = new Person();
            $person->updateName(); // ERROR: Call to Person::update method which has package visibility.
        }
    }
}
