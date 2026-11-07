<?php

declare(strict_types=1);

namespace InjectableVersionOnInterface;

use DaveLiddament\PhpLanguageExtensions\InjectableVersion;

#[InjectableVersion]
interface Repository
{
}

interface DoctrineRepository extends Repository
{
}


class InjectingCorrectVersion
{
    public function __construct(public Repository $repository) {} // OK: Repository is the InjectableVersion
}

class InjectingWrongVersion
{
    public function __construct(public DoctrineRepository $repository) {} // ERROR: DoctrineRepository injected, should inject the InjectableVersion Repository
}
