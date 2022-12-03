<?php

namespace NamespaceVisibilityOnStaticMethod {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    class Person
    {
        #[NamespaceVisibility]
        public static function updateName(): void
        {
        }

        public static function update(): void
        {
            Person::updateName(); // OK: Calls to same class allowed.
        }
    }

    class Updater
    {
        public function updater(): void
        {
            Person::updateName(); // OK: Call to Person::updateName allowed as has namespace  visibility.
        }
    }

    Person::updateName(); // OK: Call to Person::updateName allowed as has namespace  visibility.
}

namespace NamespaceVisibilityOnStaticMethod\SubNamespace {

    use NamespaceVisibilityOnStaticMethod\Person;

    class Updater
    {
        public function updater(): void
        {
            Person::updateName(); // OK: Call to Person::updateName allowed as has namespace visibility and .
        }
    }
}

namespace NamespaceVisibilityOnStaticMethod2 {

    use NamespaceVisibilityOnStaticMethod\Person;

    class AnotherUpdater
    {
        public function update(): void
        {
            Person::updateName(); // ERROR: Call to Person::updateName which has namespaceVisibility visibility
        }
    }
}
