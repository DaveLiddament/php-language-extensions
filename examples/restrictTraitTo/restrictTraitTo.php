<?php

declare(strict_types=1);

namespace RestrictTraitTo;

use DaveLiddament\PhpLanguageExtensions\RestrictTraitTo;

trait UseAnywhere {}

#[RestrictTraitTo(Interface1::class)]
trait UseOnlyOnInterface1 {}

#[RestrictTraitTo(AbstractClass1::class)]
trait UseOnlyOnAbstractClass1 {}

#[RestrictTraitTo(Class2::class)]
trait UseOnlyOnClass2 {}


interface Interface1 {}


class AClass {
    use UseAnywhere; // OK
    use UseOnlyOnInterface1; // ERROR RestrictTraitTo\Interface1
    use UseOnlyOnAbstractClass1; // ERROR RestrictTraitTo\AbstractClass1
    use UseOnlyOnClass2; // ERROR RestrictTraitTo\Class2
}


class ImplementsInterface1 implements Interface1 {
    use UseAnywhere; // OK
    use UseOnlyOnInterface1; // OK
    use UseOnlyOnAbstractClass1; // ERROR RestrictTraitTo\AbstractClass1
    use UseOnlyOnClass2; // ERROR RestrictTraitTo\Class2
}

abstract class AbstractClass1
{

}

class ExtendsAbstractClass1 extends AbstractClass1 {
    use UseAnywhere; // OK
    use UseOnlyOnInterface1; // ERROR RestrictTraitTo\Interface1
    use UseOnlyOnAbstractClass1; // OK
    use UseOnlyOnClass2; // ERROR RestrictTraitTo\Class2
}

class Class2 {
    use UseAnywhere; // OK
    use UseOnlyOnInterface1; // ERROR RestrictTraitTo\Interface1
    use UseOnlyOnAbstractClass1; // ERROR RestrictTraitTo\AbstractClass1
    use UseOnlyOnClass2; // OK
}