<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Filter;

use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\FilterAlreadyExists;
use Jgrc\Shop\Domain\Filter\FilterGroup;
use Jgrc\Shop\Domain\Filter\FilterGroupNotFound;
use Jgrc\Shop\Domain\Filter\FilterGroupRepository;
use Jgrc\Shop\Domain\Filter\FilterRepository;

class CreateFilterHandler
{
    private FilterGroupRepository $filterGroupRepository;
    private FilterRepository $filterRepository;

    public function __construct(FilterGroupRepository $filterGroupRepository, FilterRepository $filterRepository)
    {
        $this->filterGroupRepository = $filterGroupRepository;
        $this->filterRepository = $filterRepository;
    }

    public function __invoke(CreateFilter $command): void
    {
        $id = new Uuid($command->id());
        $name = new Name($command->name());
        $filterGroupId = new Uuid($command->filterGroupId());

        $this->guardIdDoesNotExists($id);

        $filterGroup = $this->loadFilterGroup($filterGroupId);
        $filterGroup->addFilter($id, $name, $command->createdAt());

        $this->filterGroupRepository->save($filterGroup);
    }

    private function guardIdDoesNotExists(Uuid $id): void
    {
        if ($this->filterRepository->byId($id)) {
            throw FilterAlreadyExists::fromId($id);
        }
    }

    private function loadFilterGroup(Uuid $id): FilterGroup
    {
        if (!$filterGroup = $this->filterGroupRepository->byId($id)) {
            throw FilterGroupNotFound::fromId($id);
        }

        return $filterGroup;
    }
}
