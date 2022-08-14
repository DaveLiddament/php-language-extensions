<?php

declare(strict_types=1);

namespace CallableFromRulesIgnoredForTestNamespace {

    use DaveLiddament\PhpLanguageExtensions\CallableFrom;


    #[CallableFrom(CallableFromUpdater::class)]
    class Person
    {
        public function updateName(): void
        {
        }
    }

    class CallableFromUpdater
    {
    }


}


namespace CallableFromRulesIgnoredForTestNamespace\Test\Person {

    use CallableFromRulesIgnoredForTestNamespace\Person;

    class PersonCheck
    {
        public function updater(Person $person): void
        {
            $person->updateName(); // OK: calling from a test namespace
        }
    }

}
