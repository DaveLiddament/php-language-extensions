<?php

declare(strict_types=1);

namespace SealedRulesIgnoredForTestNamespace {

    use DaveLiddament\PhpLanguageExtensions\Sealed;

    #[Sealed(Success::class)]
    interface Response
    {
    }

    class Success implements Response // OK: Success is permitted to implement Response
    {
    }
}

namespace SealedRulesIgnoredForTestNamespace\Test {

    use SealedRulesIgnoredForTestNamespace\Response;

    class ResponseDouble implements Response // OK: in a test namespace
    {
    }
}
