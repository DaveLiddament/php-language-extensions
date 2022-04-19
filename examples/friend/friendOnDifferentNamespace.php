<?php

namespace FriendOnDifferentNamespace1 {
    use DaveLiddament\PhpLanguageExtensions\Friend;
    use FriendOnDifferentNamespace2\Builder;

    class Employee
    {
        #[Friend(Builder::class)]
        public function update(): void
        {
        }
    }
}

namespace FriendOnDifferentNamespace2 {
    use FriendOnDifferentNamespace1\Employee;

    class Builder
    {
        public function update(Employee $employee): void
        {
            $employee->update(); // OK: Builder a friend of Employee
        }
    }
}
