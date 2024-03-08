<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

/**
 * Add the TestTag attribute to a class or a method that should only be called by test code.
 * Attempts to use or call from non-test code will raise an issue.
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
final class TestTag
{
}
