<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Application\Filter;

use Jgrc\Shop\Application\Filter\CreateFilterHandler;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\Filter;
use Jgrc\Shop\Domain\Filter\FilterAlreadyExists;
use Jgrc\Shop\Domain\Filter\FilterGroupNotFound;
use Jgrc\Shop\Domain\Filter\FilterGroupRepository;
use Jgrc\Shop\Domain\Filter\FilterRepository;
use Jgrc\Shop\Tool\Stub\Application\Filter\CreateFilterStub;
use Jgrc\Shop\Tool\Stub\Domain\Filter\FilterGroupStub;
use Jgrc\Shop\Tool\Stub\Domain\Filter\FilterStub;
use PHPUnit\Framework\TestCase;

class CreateFilterHandlerTest extends TestCase
{
    private FilterGroupRepository $filterGroupRepository;
    private FilterRepository $filterRepository;
    private CreateFilterHandler $sut;

    protected function setUp(): void
    {
        $this->filterGroupRepository = $this->createMock(FilterGroupRepository::class);
        $this->filterRepository = $this->createMock(FilterRepository::class);
        $this->sut = new CreateFilterHandler($this->filterGroupRepository, $this->filterRepository);
    }

    public function testCanBeCreatedFromValidData(): void
    {
        $command = CreateFilterStub::random();
        $id = new Uuid($command->id());
        $name = new Name($command->name());
        $filterGroupId = new Uuid($command->filterGroupId());
        $filterGroup = FilterGroupStub::random();
        $filter = new Filter($id, $name, $filterGroup, $command->createdAt());

        $this->filterRepository
            ->method('byId')
            ->with($id)
            ->willReturn(null);
        $this->filterGroupRepository
            ->method('byId')
            ->with($filterGroupId)
            ->willReturn($filterGroup);
        $this->filterGroupRepository
            ->expects($this->once())
            ->method('save')
            ->with($filterGroup);

        $this->sut->__invoke($command);

        $this->assertEquals($filter, $filterGroup->filters()->first());
    }

    public function testCannotBeCreatedFromExistingId(): void
    {
        $command = CreateFilterStub::random();
        $id = new Uuid($command->id());
        $filter = FilterStub::random();

        $this->filterRepository
            ->method('byId')
            ->with($id)
            ->willReturn($filter);
        $this->filterGroupRepository
            ->expects($this->never())
            ->method('save')
            ->with($this->any());

        $this->expectException(FilterAlreadyExists::class);

        $this->sut->__invoke($command);
    }

    public function testCannotBeCreatedBecauseFilterGroupDoesNotExist(): void
    {
        $command = CreateFilterStub::random();
        $id = new Uuid($command->id());
        $filterGroupId = new Uuid($command->filterGroupId());

        $this->filterRepository
            ->method('byId')
            ->with($id)
            ->willReturn(null);
        $this->filterGroupRepository
            ->method('byId')
            ->with($filterGroupId)
            ->willReturn(null);
        $this->filterGroupRepository
            ->expects($this->never())
            ->method('save')
            ->with($this->any());

        $this->expectException(FilterGroupNotFound::class);

        $this->sut->__invoke($command);
    }
}
