<?php

declare(strict_types=1);

namespace NamespaceVisibilityOnMethodForDifferentNamespace {

    use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;

    class Person
    {
        #[NamespaceVisibility(namespace: 'NamespaceVisibilityOnMethodDifferentNamespace')]
        public function updateName(): void
        {
        }

    }
}



namespace NamespaceVisibilityOnMethodDifferentNamespace {

    use NamespaceVisibilityOnMethodForDifferentNamespace\Person;
    class AnotherPersonUpdater
    {
        public function update(Person $person): void
        {
            $person->updateName(); // OK: call to Person::updateName from allowed namespace.
        }
    }
}


namespace NamespaceVisibilityOnMethodDifferentNamespace\SubNamespace {

    use NamespaceVisibilityOnMethodForDifferentNamespace\Person;
    class AnotherPersonUpdater
    {
        public function update(Person $person): void
        {
            $person->updateName(); // OK: call to Person::updateName from sub namespace of allowed namespace.
        }
    }
}





namespace NamespaceVisibilityOnMethodDifferentNamespace2 {

    use NamespaceVisibilityOnMethodForDifferentNamespace\Person;
    class AnotherPersonUpdater
    {
        public function update(Person $person): void
        {
            $person->updateName(); // ERROR: call to Person::updateName from a namespace that is not allowed.
        }
    }
}
