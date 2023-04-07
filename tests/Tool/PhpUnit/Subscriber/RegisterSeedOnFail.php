<?php

namespace Jgrc\Shop\Tool\PhpUnit\Subscriber;

use Jgrc\Shop\Tool\PhpUnit\Memo\Memo;
use Jgrc\Shop\Tool\PhpUnit\Memo\MemoError;
use Jgrc\Shop\Tool\Stub\RandomGenerator;
use PHPUnit\Event\Test\Failed;
use PHPUnit\Event\Test\FailedSubscriber;

class RegisterSeedOnFail implements FailedSubscriber
{
    private Memo $memo;

    public function __construct(Memo $memo)
    {
        $this->memo = $memo;
    }

    public function notify(Failed $event): void
    {
        $generator = RandomGenerator::instance();
        $this->memo->add(new MemoError($generator->seed(), $event->test()->id()));
    }
}
