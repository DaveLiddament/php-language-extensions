<?php

declare(strict_types=1);

namespace MultipleLevelsOfInheritanceOnInjectableVersionOnInterface;

use DaveLiddament\PhpLanguageExtensions\InjectableVersion;

#[InjectableVersion]
interface CorrectVersion
{
}

interface FirstLevelOfInheritance extends CorrectVersion
{
}


class SecondLevelOfInheritance implements FirstLevelOfInheritance
{
}


class InjectingCorrectVersion
{
    public function __construct(public CorrectVersion $repository) {} // OK
}

class InjectingWrongVersion1
{
    public function __construct(public FirstLevelOfInheritance $repository) {} // ERROR
}

class InjectingWrongVersion2
{
    public function __construct(public SecondLevelOfInheritance $repository) {} // ERROR
}
