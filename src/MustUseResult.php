<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

/**
 * Enforces that the result from a method call must be used.
 *
 * Assume the following class:
 * ```
 * class Money {
 *
 *   public function __construct(public readonly int $pence)
 *   {}
 *
 *   #[MustUseResult]
 *   public function add(int $pence): self
 *   {
 *     return new self($pence + $this->pence);
 *   }
 * }
 * ```
 *
 * You might misuse the `add` method in this way:
 *
 * ```
 * $cost = new Money(5);
 * $cost->add(6); // ERROR - This statement has no effect.
 * ```
 *
 * But this would be OK:
 *
 * ```
 * $cost = new Money(5);
 * $updatedCost = $cost->add(6); // OK - The return from add method is being used.
 * ```
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
final class MustUseResult
{
}
