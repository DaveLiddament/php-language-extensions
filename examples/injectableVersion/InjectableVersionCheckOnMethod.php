<?php

declare(strict_types=1);

namespace InjectableVersionCheckOnMethod;

use DaveLiddament\PhpLanguageExtensions\CheckInjectableVersion;
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
    public Repository $repository;

    #[CheckInjectableVersion]
    public function setRepository(Repository $repository): void // OK
    {
        $this->repository = $repository;
    }
}

class InjectingWrongVersion
{
    public Repository $repository;

    #[CheckInjectableVersion]
    public function setRepository(DoctrineRepository $repository): void // ERROR
    {
        $this->repository = $repository;
    }
}
