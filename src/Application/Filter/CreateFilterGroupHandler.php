<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Filter;

use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\FilterGroup;
use Jgrc\Shop\Domain\Filter\FilterGroupAlreadyExists;
use Jgrc\Shop\Domain\Filter\FilterGroupRepository;

class CreateFilterGroupHandler
{
    private FilterGroupRepository $filterGroupRepository;

    public function __construct(FilterGroupRepository $filterGroupRepository)
    {
        $this->filterGroupRepository = $filterGroupRepository;
    }

    public function __invoke(CreateFilterGroup $command): void
    {
        $id = new Uuid($command->id());
        $name = new Name($command->name());

        $this->guardIdDoesNotExists($id);

        $filterGroup = new FilterGroup($id, $name, $command->createdAt());
        $this->filterGroupRepository->save($filterGroup);
    }

    private function guardIdDoesNotExists(Uuid $id): void
    {
        if ($this->filterGroupRepository->byId($id)) {
            throw FilterGroupAlreadyExists::fromId($id);
        }
    }
}
