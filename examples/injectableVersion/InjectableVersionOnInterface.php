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
    public function __construct(public Repository $repository) {}
}

class InjectingWrongVersion
{
    public function __construct(public DoctrineRepository $repository) {}
}
