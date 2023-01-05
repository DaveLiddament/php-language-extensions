<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

/**
 * Limits the classes that can extend/implement to those listed in $permitted.
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
final class Sealed
{
    /** @param class-string ...$permitted */
    public function __construct(
        string ...$permitted,
    ) {
    }
}
