<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

use Attribute;

/**
 * Limits calling methods to those listed in $classesCallableFrom.
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
final class CallableFrom
{
    /** @param class-string ...$classesCallableFrom */
    public function __construct(
        string ...$classesCallableFrom,
    ) {
    }
}
