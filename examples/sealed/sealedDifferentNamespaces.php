<?php

declare(strict_types=1);

namespace SealedDifferentNamespaces {

    use DaveLiddament\PhpLanguageExtensions\Sealed;
    use SealedDifferentNamespaces\Responses\Failed;
    use SealedDifferentNamespaces\Responses\Success;

    #[Sealed(Success::class, Failed::class)]
    interface Response
    {
    }
}

namespace SealedDifferentNamespaces\Responses {

    use SealedDifferentNamespaces\Response;

    class Success implements Response // OK: SealedDifferentNamespaces\Responses\Success is permitted to implement Response
    {
    }

    class Failed implements Response // OK: SealedDifferentNamespaces\Responses\Failed is permitted to implement Response
    {
    }

    class AnotherClass implements Response // ERROR: AnotherClass is not permitted to implement Response, even though it is in the same namespace as the permitted classes
    {
    }
}

namespace SealedDifferentNamespaces2 {

    use SealedDifferentNamespaces\Response;

    class Success implements Response // ERROR: SealedDifferentNamespaces2\Success is not permitted to implement Response, only SealedDifferentNamespaces\Responses\Success is
    {
    }
}
