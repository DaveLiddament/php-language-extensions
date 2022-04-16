<?php

declare(strict_types=1);

namespace PackageOnMethod {

    use DaveLiddament\PhpstanPhpLanguageExtensions\Attributes\Package;

    class Person
    {
        #[Package]
        public function updateName(): void
        {
        }

        public function update(): void
        {
            $this->updateName(); // OK
        }
    }

    class Updater
    {
        public function updater(Person $person): void
        {
            $person->updateName(); // OK
        }
    }

    $person = new Person();
    $person->updateName(); // OK
}

namespace PackageOnMethod2 {

    use PackageOnMethod\Person;

    class AnotherUpdater
    {
        public function update(): void
        {
            $person = new Person();
            $person->updateName(); // ERROR
        }
    }
}
