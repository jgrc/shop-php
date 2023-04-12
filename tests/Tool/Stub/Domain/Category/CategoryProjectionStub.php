<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Category;

use Jgrc\Shop\Domain\Category\View\CategoryProjection;
use Jgrc\Shop\Tool\Stub\StringStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method CategoryProjection build()
 * @method static CategoryProjection random()
 */
class CategoryProjectionStub
{
    use Stub;

    private string $id;
    private string $name;

    final public function __construct()
    {
        $this->id = StringStub::uuid();
        $this->name = StringStub::word(3);
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
        return new CategoryProjection($this->id, $this->name);
    }
}
