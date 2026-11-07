<?php

declare(strict_types=1);

namespace SealedAnonymousClasses;

use DaveLiddament\PhpLanguageExtensions\Sealed;

#[Sealed(Success::class)]
class Response
{
}

#[Sealed(Success::class)]
interface Message
{
}

class Success extends Response implements Message // OK: Success is permitted to extend Response and implement Message
{
}

class Factory
{
    public function createResponse(): Response
    {
        return new class extends Response {}; // ERROR: anonymous classes are not permitted to extend Response
    }

    public function createMessage(): Message
    {
        return new class implements Message {}; // ERROR: anonymous classes are not permitted to implement Message
    }

    public function createSuccess(): Success
    {
        return new class extends Success {}; // OK: Success is not sealed
    }
}
