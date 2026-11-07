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
    public function __construct(public CorrectVersion $repository) {} // OK: CorrectVersion is the InjectableVersion
}

class InjectingWrongVersion1
{
    public function __construct(public FirstLevelOfInheritance $repository) {} // ERROR: FirstLevelOfInheritance injected, should inject the InjectableVersion CorrectVersion
}

class InjectingWrongVersion2
{
    public function __construct(public SecondLevelOfInheritance $repository) {} // ERROR: SecondLevelOfInheritance injected, should inject the InjectableVersion CorrectVersion
}
