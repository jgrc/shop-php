<?php

declare(strict_types=1);

namespace Jgrc\Shop\Acceptance\Context\Domain;

use Assert\Assert;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use DateTimeImmutable;
use Jgrc\Shop\Application\Filter\CreateFilter;
use Jgrc\Shop\Application\Filter\CreateFilterGroup;
use Jgrc\Shop\Domain\Common\Bus\CommandBus;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\Filter;
use Jgrc\Shop\Domain\Filter\FilterGroup;
use Jgrc\Shop\Domain\Filter\FilterGroupNotFound;
use Jgrc\Shop\Domain\Filter\FilterGroupRepository;
use Jgrc\Shop\Domain\Filter\FilterNotFound;
use Jgrc\Shop\Domain\Filter\FilterRepository;
use Jgrc\Shop\Tool\Stub\Application\Filter\CreateFilterGroupStub;
use Jgrc\Shop\Tool\Stub\Application\Filter\CreateFilterStub;

class FilterContext implements Context
{
    private CommandBus $commandBus;
    private FilterGroupRepository $filterGroupRepository;
    private FilterRepository $filterRepository;

    public function __construct(
        CommandBus $commandBus,
        FilterGroupRepository $filterGroupRepository,
        FilterRepository $filterRepository
    ) {
        $this->commandBus = $commandBus;
        $this->filterGroupRepository = $filterGroupRepository;
        $this->filterRepository = $filterRepository;
    }

    /** @Given there are the following filter groups: */
    public function thereAreFollowingFilterGroups(TableNode $tableNode): void
    {
        $createFilterGroups = array_map(
            function (array $row) {
                $builder = new CreateFilterGroupStub();
                if (array_key_exists('id', $row)) {
                    $builder->withId($row['id']);
                }
                if (array_key_exists('name', $row)) {
                    $builder->withName($row['name']);
                }
                if (array_key_exists('created_at', $row)) {
                    $builder->withCreatedAt(new DateTimeImmutable($row['created_at']));
                }
                return $builder->build();
            },
            $tableNode->getHash()
        );
        array_walk($createFilterGroups, fn(CreateFilterGroup $command) => $this->commandBus->dispatch($command));
    }

    /** @Then the following filter groups should exist: */
    public function followingFilterGroupsShouldExist(TableNode $tableNode): void
    {
        array_map(
            function (array $row) {
                Assertion::keyExists($row, 'id');
                $lazy = Assert::lazy();
                $filterGroup = $this->loadFilterGroup(new Uuid($row['id']));
                if (array_key_exists('name', $row)) {
                    $lazy = $lazy
                        ->that($row['name'])
                        ->eq($filterGroup->name()->value(), 'Unexpected name. Expected: "%s", current: "%s"');
                }
                if (array_key_exists('created_at', $row)) {
                    $lazy = $lazy
                        ->that($row['created_at'])
                        ->eq(
                            $filterGroup->createdAt()->format(DATE_ATOM),
                            'Unexpected created_at. Expected: "%s", current: "%s"'
                        );
                }
                $lazy->verifyNow();
            },
            $tableNode->getHash()
        );
    }

    /** @Given there are the following filters: */
    public function thereAreFollowingFilters(TableNode $tableNode): void
    {
        $createFilters = array_map(
            function (array $row) {
                $builder = new CreateFilterStub();
                if (array_key_exists('id', $row)) {
                    $builder->withId($row['id']);
                }
                if (array_key_exists('name', $row)) {
                    $builder->withName($row['name']);
                }
                if (array_key_exists('filter_group_id', $row)) {
                    $builder->withFilterGroupId($row['filter_group_id']);
                }
                if (array_key_exists('created_at', $row)) {
                    $builder->withCreatedAt(new DateTimeImmutable($row['created_at']));
                }
                return $builder->build();
            },
            $tableNode->getHash()
        );
        array_walk($createFilters, fn(CreateFilter $command) => $this->commandBus->dispatch($command));
    }

    /** @Then the following filters should exist: */
    public function followingFiltersShouldExist(TableNode $tableNode): void
    {
        array_map(
            function (array $row) {
                Assertion::keyExists($row, 'id');
                $lazy = Assert::lazy();
                $filter = $this->loadFilter(new Uuid($row['id']));
                if (array_key_exists('name', $row)) {
                    $lazy = $lazy
                        ->that($row['name'])
                        ->eq($filter->name()->value(), 'Unexpected name. Expected: "%s", current: "%s"');
                }
                if (array_key_exists('created_at', $row)) {
                    $lazy = $lazy
                        ->that($row['created_at'])
                        ->eq(
                            $filter->createdAt()->format(DATE_ATOM),
                            'Unexpected created_at. Expected: "%s", current: "%s"'
                        );
                }
                if (array_key_exists('filter_group_id', $row)) {
                    $lazy = $lazy
                        ->that($row['filter_group_id'])
                        ->eq(
                            $filter->filterGroup()->id()->value(),
                            'Unexpected filter_group_id. Expected: "%s", current: "%s"'
                        );
                }
                $lazy->verifyNow();
            },
            $tableNode->getHash()
        );
    }

    private function loadFilterGroup(Uuid $id): FilterGroup
    {
        if (!$filterGroup = $this->filterGroupRepository->byId($id)) {
            throw FilterGroupNotFound::fromId($id);
        }

        return $filterGroup;
    }

    private function loadFilter(Uuid $id): Filter
    {
        if (!$filter = $this->filterRepository->byId($id)) {
            throw FilterNotFound::fromId($id);
        }

        return $filter;
    }
}
