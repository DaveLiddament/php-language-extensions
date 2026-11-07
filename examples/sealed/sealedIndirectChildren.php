<?php

declare(strict_types=1);

namespace SealedIndirectChildren;

use DaveLiddament\PhpLanguageExtensions\Sealed;

#[Sealed(Success::class, Failed::class)]
class Response
{
}

class Success extends Response // OK: Success is permitted to extend Response
{
}

class Failed extends Response // OK: Failed is permitted to extend Response
{
}

class PartialSuccess extends Success // OK: Sealed only restricts direct children of Response, and Success is not sealed
{
}

#[Sealed(PermittedChild::class)]
interface Message
{
}

class PermittedChild implements Message // OK: PermittedChild is permitted to implement Message
{
}

class GrandChild extends PermittedChild // OK: Sealed only restricts direct children of Message, and PermittedChild is not sealed
{
}
