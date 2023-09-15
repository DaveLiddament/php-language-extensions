<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

/**
 * Add to a method to indicate it is overriding a method in a parent class/interface.
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
final class Override
{
    public function __construct()
    {
    }
}
