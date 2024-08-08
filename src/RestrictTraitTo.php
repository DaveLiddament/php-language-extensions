<?php

declare(strict_types=1);

namespace DaveLiddament\PhpLanguageExtensions;

/**
 * Enforces that the trait can only be used on the specified class, or children of that class.
 *
 * E.g. this trait is limited to classes that are or extend `Controller`
 *
 * ```
 * #[RestrictTraitTo(Controller::class)]
 * trait ControllerHelpers {}
 * ```
 *
 * This would be allowed:
 * ```
 * class LoginController extends Controller {
 *     use ControllerHelpers;
 * }
 * ```
 *
 * But this would NOT be allowed:
 * ```
 * class Repository {
 *     use ControllerHelpers;
 * }
 * ```
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
final class RestrictTraitTo
{
    /** @param class-string $className */
    public function __construct(
        public string $className,
    ) {
    }
}
