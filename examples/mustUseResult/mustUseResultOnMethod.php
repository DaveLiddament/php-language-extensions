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

    $class->dontNeedToUseResult(); // OK

    $class->mustUseResult(); // ERROR

    echo $class->mustUseResult(); // OK;

    $value = 1 + $class->mustUseResult(); // OK
}