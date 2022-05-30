<?php

declare(strict_types=1);

namespace TestTagOnMethodIgnoredInTestNamespace {

    use DaveLiddament\PhpLanguageExtensions\TestTag;

    class Person
    {
        #[TestTag]
        public function updateName(): void
        {
        }

    }
}

namespace TestTagOnMethodIgnoredInTestNamespace\Test {

    use TestTagOnMethodIgnoredInTestNamespace\Person;

    class PersonUpdater
    {
        public function updater(Person $person): void
        {
            $person->updateName(); // OK - Called from Test namespace
        }
    }
}

