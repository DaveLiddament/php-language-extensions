<?php

namespace NamespaceVisibilityOnStaticMethodExcludeSubNamespaces {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    class Person
    {
        #[NamespaceVisibility(excludeSubNamespaces: true)]
        public static function updateName(): void
        {
        }

    }

}

namespace NamespaceVisibilityOnStaticMethodExcludeSubNamespaces\SubNamespace {

    use NamespaceVisibilityOnStaticMethodExcludeSubNamespaces\Person;

    class Updater
    {
        public function updater(): void
        {
            Person::updateName(); // ERROR: Call to Person::updateName NOT allowed as sub namespace not allowed.
        }
    }
}
