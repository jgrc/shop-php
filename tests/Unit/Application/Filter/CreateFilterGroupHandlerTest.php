<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Application\Filter;

use Jgrc\Shop\Application\Filter\CreateFilterGroupHandler;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\FilterGroup;
use Jgrc\Shop\Domain\Filter\FilterGroupAlreadyExists;
use Jgrc\Shop\Domain\Filter\FilterGroupRepository;
use Jgrc\Shop\Tool\Stub\Application\Filter\CreateFilterGroupStub;
use Jgrc\Shop\Tool\Stub\Domain\Filter\FilterGroupStub;
use PHPUnit\Framework\TestCase;

class CreateFilterGroupHandlerTest extends TestCase
{
    private FilterGroupRepository $filterGroupRepository;
    private CreateFilterGroupHandler $sut;

    protected function setUp(): void
    {
        $this->filterGroupRepository = $this->createMock(FilterGroupRepository::class);
        $this->sut = new CreateFilterGroupHandler($this->filterGroupRepository);
    }

    public function testCanBeCreatedFromValidData(): void
    {
        $command = CreateFilterGroupStub::random();
        $id = new Uuid($command->id());
        $name = new Name($command->name());
        $filterGroup = new FilterGroup($id, $name, $command->createdAt());

        $this->filterGroupRepository
            ->method('byId')
            ->with($id)
            ->willReturn(null);
        $this->filterGroupRepository
            ->expects($this->once())
            ->method('save')
            ->with($filterGroup);

        $this->sut->__invoke($command);
    }

    public function testCannotBeCreatedFromExistingId(): void
    {
        $command = CreateFilterGroupStub::random();
        $filterGroup = FilterGroupStub::random();
        $id = new Uuid($command->id());

        $this->filterGroupRepository
            ->method('byId')
            ->with($id)
            ->willReturn($filterGroup);
        $this->filterGroupRepository
            ->expects($this->never())
            ->method('save')
            ->with($this->any());

        $this->expectException(FilterGroupAlreadyExists::class);

        $this->sut->__invoke($command);
    }
}
