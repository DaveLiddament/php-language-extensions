<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

/**
 * Add the TestTag attribute to a method that should only be called by test code.
 * Attempts to call from non-test code will raise an issue.
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
final class TestTag
{
}
