<?php

declare(strict_types=1);

namespace SealedClasses;

use DaveLiddament\PhpLanguageExtensions\Sealed;

class Success extends Response // OK
{
}

class Failed extends Response // OK
{
}

#[Sealed(Success::class, Failed::class)]
class Response
{
}


class AnotherClass extends Response // ERROR AnotherClass can not extend Response
{
}
