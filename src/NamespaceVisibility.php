<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
final class NamespaceVisibility
{
    public function __construct(
        ?string $namespace = null,
        bool $excludeSubNamespaces = false,
    ) {
    }
}
