<?php

declare(strict_types=1);

// Enums require PHP 8.1 or later.

namespace SealedEnums;

use DaveLiddament\PhpLanguageExtensions\Sealed;

#[Sealed(Status::class)]
interface HasLabel
{
}

enum Status: string implements HasLabel // OK: Status is permitted to implement HasLabel
{
    case Active = 'active';
    case Inactive = 'inactive';
}

enum Priority implements HasLabel // ERROR: Priority is not permitted to implement HasLabel
{
    case High;
    case Low;
}
