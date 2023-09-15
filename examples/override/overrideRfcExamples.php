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
        public function i();
    }

    interface II extends I {
        #[Override]
        public function i();
    }

    class P {
        public function p1() {}
        public function p2() {}
        public function p3() {}
        public function p4() {}
    }

    class PP extends P {
        #[Override]
        public function p1() {}
        public function p2() {}
        #[Override]
        public function p3() {}
    }

    class C extends PP implements I {
        #[Override]
        public function i() {}
        #[Override]
        public function p1() {}
        #[Override]
        public function p2() {}
        public function p3() {}
        #[Override]
        public function p4() {}
        public function c() {}
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

