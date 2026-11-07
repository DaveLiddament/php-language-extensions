<?php

declare(strict_types=1);

namespace IterableInjectableVersion;

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
    /** @param Repository[] $repositories */
    public function __construct(public array $repositories) {} // OK: iterable of the InjectableVersion Repository
}

class InjectingWrongVersion
{
    /** @param DoctrineRepository[] $repositories */
    public function __construct(public iterable $repositories) {} // ERROR: iterable of DoctrineRepository, should be an iterable of the InjectableVersion Repository
}

class InjectingWrongVersion2
{
    /** @param DoctrineRepository[] $repositories */
    public function __construct($repositories) {var_export($repositories);} // ERROR: iterable of DoctrineRepository, should be an iterable of the InjectableVersion Repository
}
