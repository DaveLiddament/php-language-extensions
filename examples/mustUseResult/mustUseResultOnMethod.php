<?php

namespace MustUseResultOnMethod {


    use DaveLiddament\PhpLanguageExtensions\MustUseResult;

    class AClass {

        #[MustUseResult]
        public function mustUseResult(): int
        {
            return 1;
        }

        public function dontNeedToUseResult(): int
        {
            return 2;
        }

    }


    $class = new AClass();

    $class->dontNeedToUseResult(); // OK: dontNeedToUseResult does not have the MustUseResult attribute

    $class->mustUseResult(); // ERROR: Result of mustUseResult is not used

    echo $class->mustUseResult(); // OK: Result of mustUseResult is used

    $value = 1 + $class->mustUseResult(); // OK: Result of mustUseResult is used
}