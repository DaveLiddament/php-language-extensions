<?php

declare(strict_types=1);

namespace OverrideOnInterface {


    use DaveLiddament\PhpLanguageExtensions\Override;

    abstract class AnInterface {

        abstract public function method1(): void;

        public function method2(): void {}

        public function anotherMethod(): void {}

    }


    class Class1 extends AnInterface {

        #[Override] public function method1(): void
        {
        }

        #[Override] public function method2(): void
        {
        }

        #[Override] public function method4(): void // ERROR method4
        {
        }
    }


    new class extends AnInterface {
        #[Override] public function method1(): void
        {
        }

        #[Override] public function method2(): void
        {
        }

        #[Override] public function method3(): void // ERROR method3
        {
        }
    };

}