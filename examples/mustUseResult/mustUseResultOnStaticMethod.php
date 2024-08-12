<?php

namespace MustUseResultOnMethod {


    use DaveLiddament\PhpLanguageExtensions\MustUseResult;

    class AClass {

        #[MustUseResult]
        public static function mustUseResult(): int
        {
            return 1;
        }

        public static function dontNeedToUseResult(): int
        {
            return 2;
        }

    }


    AClass::dontNeedToUseResult(); // OK

    AClass::mustUseResult(); // ERROR

    echo AClass::mustUseResult(); // OK;

    $value = 1 + AClass::mustUseResult(); // OK
}