<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub;

trait Stub
{
    /** @var callable[] */
    private array $callables = [];

    abstract protected function instance(): object;

    final protected function on(callable $callable): self
    {
        $this->callables[] = $callable;
        return $this;
    }

    final public function build(): object
    {
        $stub = $this->instance();
        array_walk($this->callables, fn(callable $callable) => $callable($stub));

        return $stub;
    }

    final public static function random(): object
    {
        return (new static())->build();
    }
}
