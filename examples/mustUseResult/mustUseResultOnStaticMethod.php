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


    AClass::dontNeedToUseResult(); // OK: dontNeedToUseResult does not have the MustUseResult attribute

    AClass::mustUseResult(); // ERROR: Result of mustUseResult is not used

    echo AClass::mustUseResult(); // OK: Result of mustUseResult is used

    $value = 1 + AClass::mustUseResult(); // OK: Result of mustUseResult is used
}