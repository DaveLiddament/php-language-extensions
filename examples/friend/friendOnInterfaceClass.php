<?php

namespace FriendOnInterfaceClass;

use DaveLiddament\PhpLanguageExtensions\Friend;

#[Friend(MessageSendingService::class)]
interface MessageSender
{
    public function sendMessage(): void;
}


class PhpMailerMessageSender implements MessageSender
{
    public function sendMessage(): void
    {
    }
}


class MessageSendingService
{
    public function __construct(public MessageSender $messageSender) {}

    public function sendMessage(): void
    {
        $this->messageSender->sendMessage(); // OK: MessageSendingService is a Friend of MessageSender
    }
}

class Foo
{
    public function __construct(public MessageSender $messageSender) {}

    public function sendMessage(): void
    {
        $this->messageSender->sendMessage(); // ERROR: Foo is not a Friend of MessageSender
    }
}
