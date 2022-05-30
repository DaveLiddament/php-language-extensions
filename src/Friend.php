<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

use Attribute;

/**
 * Limits calling methods to those listed as the method's or class's friends.
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class Friend
{
    /** @param class-string ...$friends */
    public function __construct(
       string ...$friends,
    ) {
    }
}
