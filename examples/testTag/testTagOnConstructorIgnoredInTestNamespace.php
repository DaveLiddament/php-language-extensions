<?php

namespace TestTagOnConstructorIgnoredInTestNamespace {

    use DaveLiddament\PhpLanguageExtensions\TestTag;

    class Person
    {
        #[TestTag]
        public function __construct()
        {
        }
    }

}


namespace TestTagOnConstructorIgnoredInTestNamespace\Test {

    use TestTagOnConstructorIgnoredInTestNamespace\Person;

    class PersonBuilder
    {
        public function buildPerson(): Person
        {
            return new Person(); // OK TetTag called from the test namespace
        }
    }

}
