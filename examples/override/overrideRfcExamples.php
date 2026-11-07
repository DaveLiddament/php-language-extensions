<?php

declare(strict_types=1);

namespace overrideRfcExample1 {


    use DaveLiddament\PhpLanguageExtensions\Override;

    class P {
        protected function p(): void {}
    }

    class C extends P {
        #[Override]
        public function p(): void {}
    }
}

namespace overrideRfcExample2 {

    use DaveLiddament\PhpLanguageExtensions\Override;

    class Foo implements \IteratorAggregate
    {
        #[Override]
        public function getIterator(): \Traversable
        {
            yield from [];
        }
    }
}


namespace overrideRfcExample5 {

    use DaveLiddament\PhpLanguageExtensions\Override;

    interface I {
        public function i(): void;
    }

    interface II extends I {
        #[Override]
        public function i(): void;
    }

    class P {
        public function p1(): void {}
        public function p2(): void {}
        public function p3(): void {}
        public function p4(): void {}
    }

    class PP extends P {
        #[Override]
        public function p1(): void {}
        public function p2(): void {}
        #[Override]
        public function p3(): void {}
    }

    class C extends PP implements I {
        #[Override]
        public function i(): void {}
        #[Override]
        public function p1(): void {}
        #[Override]
        public function p2(): void {}
        public function p3(): void {}
        #[Override]
        public function p4(): void {}
        public function c(): void {}
    }
}

namespace overrideRfcExample6 {

    use DaveLiddament\PhpLanguageExtensions\Override;

    class C
    {
        #[Override] public function c(): void {} // ERROR c
    }
}

namespace overrideRfcExample7 {

    use DaveLiddament\PhpLanguageExtensions\Override;

    interface I {
        public function i(): void;
    }

    class P {
        #[Override] public function i(): void {} // ERROR i
    }

    class C extends P implements I {}
}



namespace overrideRfcExample9 {

    use DaveLiddament\PhpLanguageExtensions\Override;

    class P {
        private function p(): void {}
    }

    class C extends P {
        #[Override] public function p(): void {} // ERROR p
    }
}

