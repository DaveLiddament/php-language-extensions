<?php

namespace CallableFromOnDifferentNamespace1 {
    use DaveLiddament\PhpLanguageExtensions\CallableFrom;
    use CallableFromOnDifferentNamespace2\Builder;

    class Employee
    {
        #[CallableFrom(Builder::class)]
        public function update(): void
        {
        }
    }
}

namespace CallableFromOnDifferentNamespace2 {
    use CallableFromOnDifferentNamespace1\Employee;

    class Builder
    {
        public function update(Employee $employee): void
        {
            $employee->update(); // OK: Builder a callableFrom of Employee
        }
    }
}
