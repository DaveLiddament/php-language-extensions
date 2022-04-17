<?php

namespace FriendNameSpace1 {
    use DaveLiddament\PhpLanguageExtensions\Friend;

    class Employee
    {
        #[Friend(Foo\Bar\Builder::class)]
        public function update(): void
        {
        }
    }
}

namespace FriendNameSpace1\Foo\Bar {
    use FriendNameSpace1\Employee;

    class Builder
    {
        public function update(Employee $employee): void
        {
            $employee->update(); // OK
        }
    }
}
