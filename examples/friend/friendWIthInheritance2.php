<?php

declare(strict_types=1);

namespace FriendWithInheritance2;

use DaveLiddament\PhpLanguageExtensions\Friend;


interface Command
{
    #[Friend(CommandProcessor::class)]
    public function execute(): void;
}

class PrintCommand implements Command
{

    public function execute(): void
    {
    }
}


interface CommandProcessor
{
    public function process(Command $command);
}

class PrintCommandProcessor implements CommandProcessor
{
    public function process(Command $command): void
    {
        $command->execute(); // OK
    }
}


class AnotherClass
{
    public function process(Command $command):  void
    {
        $command->execute(); // ERROR
    }
}