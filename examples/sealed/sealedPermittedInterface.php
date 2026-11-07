<?php

declare(strict_types=1);

namespace SealedPermittedInterface;

use DaveLiddament\PhpLanguageExtensions\Sealed;

#[Sealed(SuccessResponse::class, Failed::class)]
interface Response
{
}

interface SuccessResponse extends Response // OK: SuccessResponse is permitted to extend Response
{
}

class Failed implements Response // OK: Failed is permitted to implement Response
{
}

class Created implements SuccessResponse // OK: Created implements the permitted SuccessResponse, not Response directly
{
}

class Accepted implements SuccessResponse // OK: Accepted implements the permitted SuccessResponse, not Response directly
{
}

class AnotherClass implements Response // ERROR: AnotherClass is not permitted to implement Response
{
}
