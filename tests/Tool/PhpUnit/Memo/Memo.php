<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\PhpUnit\Memo;

class Memo
{
    /** @var MemoError[] */
    private array $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function add(MemoError $memoError): void
    {
        $this->errors[] = $memoError;
    }

    /** @return MemoError[] */
    public function errors(): array
    {
        return $this->errors;
    }
}
