<?php

namespace Jgrc\Shop\Tool\PhpUnit\Subscriber;

use Jgrc\Shop\Tool\PhpUnit\Memo\Memo;
use PHPUnit\Event\TestRunner\ExecutionFinished;
use PHPUnit\Event\TestRunner\ExecutionFinishedSubscriber;

class ShowSeeds implements ExecutionFinishedSubscriber
{
    private Memo $memo;

    public function __construct(Memo $memo)
    {
        $this->memo = $memo;
    }

    public function notify(ExecutionFinished $event): void
    {
        print PHP_EOL . PHP_EOL;
        foreach ($this->memo->errors() as $memoError) {
            print $memoError . PHP_EOL;
        }
    }
}
