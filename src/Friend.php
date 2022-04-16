<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class Friend
{
    /** @param class-string|array<int,class-string> $friends */
    public function __construct(
        public string|array $friends,
    ) {
    }
}
