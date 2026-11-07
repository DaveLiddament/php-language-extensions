<?php

declare(strict_types=1);

namespace SealedRulesIgnoredForTestClass;

use DaveLiddament\PhpLanguageExtensions\Sealed;

#[Sealed(Success::class)]
interface Response
{
}

class Success implements Response // OK: Success is permitted to implement Response
{
}

class ResponseTest implements Response // OK: class with a name ending Test
{
}
