<?php

declare(strict_types=1);

namespace SealedInterfaceExtendsInterface;

use DaveLiddament\PhpLanguageExtensions\Sealed;

#[Sealed(Success::class, Failed::class)]
interface Response
{
}

class Success implements Response // OK: Success is permitted to implement Response
{
}

class Failed implements Response // OK: Failed is permitted to implement Response
{
}

interface AnotherResponse extends Response // ERROR: AnotherResponse is not permitted to extend Response
{
}

interface Loggable
{
}

interface LoggableResponse extends Loggable, Response // ERROR: LoggableResponse is not permitted to extend Response
{
}
