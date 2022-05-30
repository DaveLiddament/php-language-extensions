<?php

namespace TestTagOnStaticMethodIgnoredInTestNamepace {


    use DaveLiddament\PhpLanguageExtensions\TestTag;

    class Person
    {
        #[TestTag]
        public static function updateName(): void
        {
        }
    }
}

namespace TestTagOnStaticMethodIgnoredInTestNamepace\Test {

    use TestTagOnStaticMethodIgnoredInTestNamepace\Person;

    class PersonUpdater
    {
        public function updater(): void
        {
            Person::updateName(); // OK - Called from a test namespace
        }
    }
}
