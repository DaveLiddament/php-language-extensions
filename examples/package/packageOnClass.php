<?php

declare(strict_types=1);

namespace PackageOnClass {

    use DaveLiddament\PhpstanPhpLanguageExtensions\Attributes\Package;


    #[Package]
    class Person
    {
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


namespace PackageOnClass2 {

    use PackageOnClass\Person;

    class AnotherUpdater
    {
        public function update(): void
        {
            $person = new Person();
            $person->updateName(); // ERROR
        }
    }
}
