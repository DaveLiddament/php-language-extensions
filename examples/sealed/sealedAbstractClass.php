<?php

declare(strict_types=1);

namespace SealedAbstractClass;

use DaveLiddament\PhpLanguageExtensions\Sealed;

#[Sealed(Success::class, Failure::class)]
abstract class Result
{
}

class Success extends Result // OK: Success is permitted to extend Result
{
}

class Failure extends Result // OK: Failure is permitted to extend Result
{
}

class AnotherClass extends Result // ERROR: AnotherClass is not permitted to extend Result
{
}
