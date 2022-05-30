<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

use Attribute;

/**
 * Limits the classes that can extend/implement to those listed in $permitted.
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Sealed
{
    /** @param class-string ...$permitted */
    public function __construct(
        string ...$permitted,
    ) {
    }
}
