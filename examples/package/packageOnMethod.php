<?php

declare(strict_types=1);

namespace PackageOnMethod {

    use DaveLiddament\PhpLanguageExtensions\Package;

    class Person
    {
        #[Package]
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

namespace PackageOnMethod2 {

    use PackageOnMethod\Person;

    class AnotherUpdater
    {
        public function update(): void
        {
            $person = new Person();
            $person->updateName(); // ERROR: Call to Person::updateName which has package visibility
        }
    }
}
