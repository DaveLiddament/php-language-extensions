<?php

namespace PackageOnStaticMethod {

    use DaveLiddament\PhpLanguageExtensions\Package;

    class Person
    {
        #[Package]
        public static function updateName(): void
        {
        }

        public static function update(): void
        {
            Person::updateName(); // OK: Calls to same class allowed.
        }
    }

    class Updater
    {
        public function updater(): void
        {
            Person::updateName(); // OK: Call to Person::updateName allowed as has package visibility.
        }
    }

    Person::updateName(); // OK: Call to Person::updateName allowed as has package visibility.
}


namespace PackageOnStaticMethod2 {

    use PackageOnStaticMethod\Person;

    class AnotherUpdater
    {
        public function update(): void
        {
            Person::updateName(); // ERROR: Call to Person::updateName which has package visibility
        }
    }
}
