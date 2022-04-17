<?php

declare(strict_types=1);

namespace FriendRulesIgnoredForTestNamespace {

    use DaveLiddament\PhpLanguageExtensions\Friend;


    #[Friend(FriendUpdater::class)]
    class Person
    {
        public function updateName(): void
        {
        }
    }

    class FriendUpdater
    {
    }


}


namespace FriendRulesIgnoredForTestNamespace\Test\Person {

    use FriendRulesIgnoredForTestNamespace\Person;

    class PersonCheck
    {
        public function updater(Person $person): void
        {
            $person->updateName(); // OK calling from a test namespace
        }
    }

}
