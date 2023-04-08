<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\PhpUnit\Subscriber;

use Jgrc\Shop\Tool\PhpUnit\Memo\Memo;
use Jgrc\Shop\Tool\PhpUnit\Memo\MemoError;
use Jgrc\Shop\Tool\Stub\RandomGenerator;
use PHPUnit\Event\Test\Errored;
use PHPUnit\Event\Test\ErroredSubscriber;

class RegisterSeedOnError implements ErroredSubscriber
{
    private Memo $memo;

    public function __construct(Memo $memo)
    {
        $this->memo = $memo;
    }

    public function notify(Errored $event): void
    {
        $generator = RandomGenerator::instance();
        $this->memo->add(new MemoError($generator->seed(), $event->test()->id()));
    }
}
