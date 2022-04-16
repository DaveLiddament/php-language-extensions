<?php

declare(strict_types=1);

namespace PackageRulesIgnoredForTestClass {

    use DaveLiddament\PhpstanPhpLanguageExtensions\Attributes\Package;


    #[Package]
    class Person
    {
        public function updateName(): void
        {
        }
    }
}

namespace PackageRulesIgnoredForTestClass\Person {

    use PackageRulesIgnoredForTestClass\Person;

    class PersonTest
    {
        public function updater(Person $person): void
        {
            $person->updateName(); // OK calling from a class with a name ending Test
        }
    }

}
