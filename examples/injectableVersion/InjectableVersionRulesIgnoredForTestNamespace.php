<?php

declare(strict_types=1);

namespace InjectableVersionRulesIgnoredForTestNamespace {

    use DaveLiddament\PhpLanguageExtensions\InjectableVersion;

    #[InjectableVersion]
    interface Repository
    {
    }
}


namespace InjectableVersionRulesIgnoredForTestNamespace\Test {

    use InjectableVersionRulesIgnoredForTestNamespace\Repository;

    class RepositoryDouble implements Repository
    {
    }

    class ServiceDouble
    {
        public function __construct(public RepositoryDouble $repository) // OK: in test namespace, which is excluded from checks
        {
        }
    }

}
