<?php

declare(strict_types=1);

namespace NamespaceVisibilityRulesIgnoredForTestNamespace {


    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    #[NamespaceVisibility]
    class Person
    {
        public function updateName(): void
        {
        }
    }

}


namespace NamespaceVisibilityRulesIgnoredForTestNamespace\Test\Person {

    use NamespaceVisibilityRulesIgnoredForTestNamespace\Person;

    class PersonCheck
    {
        public function updater(Person $person): void
        {
            $person->updateName(); // OK: calling from a test namespace
        }
    }

}
