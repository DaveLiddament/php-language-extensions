<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Sealed
{
    /** @param class-string|array<int,class-string> $friends */
    public function __construct(
        public string|array $friends,
    ) {
    }
}
