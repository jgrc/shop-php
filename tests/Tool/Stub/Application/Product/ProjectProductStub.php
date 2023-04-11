<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Application\Product;

use Jgrc\Shop\Application\Product\ProjectProduct;
use Jgrc\Shop\Tool\Stub\StringStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method ProjectProduct build()
 * @method static ProjectProduct random()
 */
class ProjectProductStub
{
    use Stub;

    private string $id;

    final public function __construct()
    {
        $this->id = StringStub::uuid();
    }

    public function withId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    protected function instance(): object
    {
        return new ProjectProduct($this->id);
    }
}
