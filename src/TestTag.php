<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

use Attribute;

/**
 * Add the TestTag attribute to a method that should only be called by test code.
 */
#[Attribute(Attribute::TARGET_METHOD)]
class TestTag
{
}
