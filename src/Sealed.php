<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Sealed
{
    /** @param class-string ...$permitted */
    public function __construct(
        string ...$permitted,
    ) {
    }
}
