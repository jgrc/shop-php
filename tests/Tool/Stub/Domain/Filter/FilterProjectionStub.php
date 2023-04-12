<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Filter;

use Jgrc\Shop\Domain\Filter\View\FilterProjection;
use Jgrc\Shop\Tool\Stub\StringStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method FilterProjection build()
 * @method static FilterProjection random()
 */
class FilterProjectionStub
{
    use Stub;

    private string $id;
    private string $name;

    final public function __construct()
    {
        $this->id = StringStub::uuid();
        $this->name = StringStub::word();
    }

    public function withId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    protected function instance(): object
    {
        return new FilterProjection($this->id, $this->name);
    }
}
