<?php

declare(strict_types=1);

namespace SealedNoPermittedClasses;

use DaveLiddament\PhpLanguageExtensions\Sealed;

#[Sealed]
class Response
{
}

#[Sealed]
interface Message
{
}

class Success extends Response // ERROR: Response has no permitted classes, so nothing can extend it
{
}

class Email implements Message // ERROR: Message has no permitted classes, so nothing can implement it
{
}
