<?php

declare(strict_types=1);

namespace SealedSinglePermittedClass;

use DaveLiddament\PhpLanguageExtensions\Sealed;

#[Sealed(OnlyChild::class)]
abstract class Parent1
{
}

class OnlyChild extends Parent1 // OK: OnlyChild is the only class permitted to extend Parent1
{
}

class AnotherChild extends Parent1 // ERROR: AnotherChild is not permitted to extend Parent1
{
}
