<?php

declare(strict_types=1);

namespace SealedMultipleInterfaces;

use DaveLiddament\PhpLanguageExtensions\Sealed;

interface Loggable
{
}

#[Sealed(Success::class)]
interface Response
{
}

#[Sealed(Success::class)]
interface Cacheable
{
}

class Success implements Loggable, Response, Cacheable // OK: Success is permitted to implement Response and Cacheable, Loggable is not sealed
{
}

class LoggableResponse implements Loggable, Response // ERROR: LoggableResponse is not permitted to implement Response
{
}

class CacheableResponse implements Response, Cacheable // ERROR: CacheableResponse is not permitted to implement Response or Cacheable
{
}
