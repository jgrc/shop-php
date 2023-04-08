<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Application\Category;

use Jgrc\Shop\Application\Category\CreateCategoryHandler;
use Jgrc\Shop\Domain\Category\CategoryRepository;
use Jgrc\Shop\Domain\Category\Service\CategoryFactory;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Tool\Stub\Application\Category\CreateCategoryStub;
use Jgrc\Shop\Tool\Stub\Domain\Category\CategoryStub;
use PHPUnit\Framework\TestCase;

class CreateCategoryHandlerTest extends TestCase
{
    private CategoryFactory $categoryFactory;
    private CategoryRepository $categoryRepository;
    private CreateCategoryHandler $sut;

    protected function setUp(): void
    {
        $this->categoryFactory = $this->createMock(CategoryFactory::class);
        $this->categoryRepository = $this->createMock(CategoryRepository::class);
        $this->sut = new CreateCategoryHandler($this->categoryFactory, $this->categoryRepository);
    }

    public function testCanBeCreatedFromValidData(): void
    {
        $command = CreateCategoryStub::random();
        $category = CategoryStub::random();

        $this->categoryFactory
            ->method('__invoke')
            ->with(new Uuid($command->id()), new Name($command->name()), $command->createdAt())
            ->willReturn($category);
        $this->categoryRepository
            ->expects($this->exactly(1))
            ->method('save')
            ->with($category);

        $this->sut->__invoke($command);
    }
}
