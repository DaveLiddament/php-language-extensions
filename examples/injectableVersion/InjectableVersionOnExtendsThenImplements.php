<?php

declare(strict_types=1);

namespace InjectableVersionOnExtendsThenImplements;

use DaveLiddament\PhpLanguageExtensions\InjectableVersion;

#[InjectableVersion]
interface Repository
{
}

class AbstractDoctrineRepository implements Repository
{
}


class DoctrineRepository extends AbstractDoctrineRepository
{
}

class InjectingWrongVersion1
{
    public function __construct(public AbstractDoctrineRepository $repository) {} // ERROR: AbstractDoctrineRepository injected, should inject the InjectableVersion Repository
}

class InjectingWrongVersion2
{
    public function __construct(public DoctrineRepository $repository) {} // ERROR: DoctrineRepository injected, should inject the InjectableVersion Repository
}
