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
    public function __construct(public array $repositories) {} // OK
}

class InjectingWrongVersion
{
    /** @param DoctrineRepository[] $repositories */
    public function __construct(public iterable $repositories) {} // ERROR
}

class InjectingWrongVersion2
{
    /** @param DoctrineRepository[] $repositories */
    public function __construct($repositories) {var_export($repositories);} // ERROR
}
