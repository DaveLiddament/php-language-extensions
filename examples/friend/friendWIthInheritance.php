<?php

declare(strict_types=1);

namespace FriendWithInheritance;

use DaveLiddament\PhpLanguageExtensions\Friend;


interface Emailer
{
    #[Friend(EmailQueueProcessor::class)]
    public function sendEmail(): void;
}

class PhpMailer implements Emailer
{
    public function sendEmail(): void
    {
    }
}


class EmailQueueProcessor
{
    public function sendEmail(): void
    {
        $mailer = new PhpMailer();
        $mailer->sendEmail(); // OK
    }
}

class AnotherClass {
    public function sendEmail(): void
    {
        $mailer = new PhpMailer();
        $mailer->sendEmail(); // ERROR
    }
}


