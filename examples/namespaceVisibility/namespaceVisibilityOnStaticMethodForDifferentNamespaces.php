<?php

namespace NamespaceVisibilityOnStaticMethodForDifferentNamespaces {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    class Person
    {
        #[NamespaceVisibility(namespace: 'NamespaceVisibilityOnStaticMethodDifferentNamespaces')]
        public static function updateName(): void
        {
        }

    }

}

namespace NamespaceVisibilityOnStaticMethodDifferentNamespaces {

    use NamespaceVisibilityOnStaticMethodForDifferentNamespaces\Person;

    class Updater
    {
        public function updater(): void
        {
            Person::updateName(); // OK. Call to Person::updateName allowed from given namespace.
        }
    }
}
