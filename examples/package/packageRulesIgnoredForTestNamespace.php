<?php

declare(strict_types=1);

namespace PackageRulesIgnoredForTestNamespace {


    use DaveLiddament\PhpLanguageExtensions\Package;

    #[Package]
    class Person
    {
        public function updateName(): void
        {
        }
    }

}


namespace PackageRulesIgnoredForTestNamespace\Test\Person {

    use PackageRulesIgnoredForTestNamespace\Person;

    class PersonCheck
    {
        public function updater(Person $person): void
        {
            $person->updateName(); // OK calling from a test namespace
        }
    }

}
