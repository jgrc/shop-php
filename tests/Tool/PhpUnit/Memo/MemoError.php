<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\PhpUnit\Memo;

use Stringable;

class MemoError implements Stringable
{
    private int $seed;
    private string $test;

    public function __construct(int $seed, string $test)
    {
        $this->seed = $seed;
        $this->test = $test;
    }

    public function __toString()
    {
        return sprintf('%s -> Seed %d', $this->test, $this->seed);
    }
}
