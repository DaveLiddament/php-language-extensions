<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

/**
 * @deprecated use #[NamespaceVisibility]
 * Limit calls to classes or methods with the Package attribute to calls from classes in the name namespace
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
final class Package
{
}
