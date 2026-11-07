<?php

declare(strict_types=1);

namespace InjectableVersionOnClass;

use DaveLiddament\PhpLanguageExtensions\InjectableVersion;

#[InjectableVersion]
abstract class Repository
{
}

class DoctrineRepository extends Repository
{
}


class InjectingCorrectVersion
{
    public function __construct(
        public Repository $repository,
        public int $int
    ) {} // OK: Repository is the InjectableVersion
}

class InjectingWrongVersion
{
    /** @param mixed $unknownType */
    public function __construct(
        public string $string,
        public $unknownType,
        public DoctrineRepository $repository
    ) {} // ERROR: DoctrineRepository injected, should inject the InjectableVersion Repository
}
