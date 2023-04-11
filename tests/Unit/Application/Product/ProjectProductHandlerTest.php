<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Application\Product;

use Jgrc\Shop\Application\Product\ProjectProductHandler;
use Jgrc\Shop\Domain\Common\Service\Clock;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Product\View\ProductProjector;
use Jgrc\Shop\Domain\Product\View\ProductStore;
use Jgrc\Shop\Tool\Stub\Application\Product\ProjectProductStub;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\Domain\Product\ProductProjectionStub;
use PHPUnit\Framework\TestCase;

class ProjectProductHandlerTest extends TestCase
{
    private ProductProjector $productProjector;
    private ProductStore $productStore;
    private Clock $clock;
    private ProjectProductHandler $sut;

    protected function setUp(): void
    {
        $this->productProjector = $this->createMock(ProductProjector::class);
        $this->productStore = $this->createMock(ProductStore::class);
        $this->clock = $this->createMock(Clock::class);
        $this->sut = new ProjectProductHandler(
            $this->productProjector,
            $this->productStore,
            $this->clock
        );
    }

    public function testCanBeProjected(): void
    {
        $command = ProjectProductStub::random();
        $now = DateTimeImmutableStub::random();
        $productProjection = ProductProjectionStub::random();

        $this->clock
            ->method('now')
            ->willReturn($now);
        $this->productProjector
            ->method('create')
            ->with(new Uuid($command->id()), $now)
            ->willReturn($productProjection);
        $this->productStore
            ->expects($this->once())
            ->method('save')
            ->with($productProjection);

        $this->sut->__invoke($command);
    }
}
