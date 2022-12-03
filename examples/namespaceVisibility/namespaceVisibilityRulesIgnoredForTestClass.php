<?php

declare(strict_types=1);

namespace NamespaceVisibilityRulesIgnoredForTestClass {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;


    #[NamespaceVisibility]
    class Person
    {
        public function updateName(): void
        {
        }
    }
}

namespace NamespaceVisibilityRulesIgnoredForTestClass\Person {

    use NamespaceVisibilityRulesIgnoredForTestClass\Person;

    class PersonTest
    {
        public function updater(Person $person): void
        {
            $person->updateName(); // OK: calling from a class with a name ending Test
        }
    }

}
