<?php

namespace PackageOnStaticMethod {

    use DaveLiddament\PhpstanPhpLanguageExtensions\Attributes\Package;

    class Person
    {
        #[Package]
        public static function updateName(): void
        {
        }

        public static function update(): void
        {
            Person::updateName(); // OK
        }
    }

    class Updater
    {
        public function updater(): void
        {
            Person::updateName(); // OK
        }
    }

    Person::updateName(); // OK
}


namespace PackageOnStaticMethod2 {

    use PackageOnStaticMethod\Person;

    class AnotherUpdater
    {
        public function update(): void
        {
            Person::updateName(); // ERROR
        }
    }
}
