<?php

declare(strict_types=1);

namespace SealedInterfaces;

use DaveLiddament\PhpLanguageExtensions\Sealed;

class Success implements Response // OK
{
}

class Failed implements Response // OK
{
}

#[Sealed(Success::class, Failed::class)]
interface Response
{
}


class AnotherClass implements Response // ERROR AnotherClass can not implement Response
{
}
