<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class Friend
{
    /** @param class-string ...$friends */
    public function __construct(
       string ...$friends,
    ) {
    }
}
