<?php

declare(strict_types=1);

namespace MultipleLevelsOfInheritanceNoInjectableVersionOnInterface;


interface CorrectVersion
{
}

interface FirstLevelOfInheritance
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
    public function __construct(public FirstLevelOfInheritance $repository) {} // OK
}

class InjectingWrongVersion2
{
    public function __construct(public SecondLevelOfInheritance $repository) {} // OK
}
