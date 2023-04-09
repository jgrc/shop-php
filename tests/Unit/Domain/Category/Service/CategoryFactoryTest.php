<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Domain\Category\Service;

use Jgrc\Shop\Domain\Category\Category;
use Jgrc\Shop\Domain\Category\Service\CategoryFactory;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\NameStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\UuidStub;
use PHPUnit\Framework\TestCase;

class CategoryFactoryTest extends TestCase
{
    private CategoryFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new CategoryFactory();
    }

    public function testCanBeCreatedFromValidData(): void
    {
        $id = UuidStub::random();
        $name = NameStub::random();
        $createdAt = DateTimeImmutableStub::random();
        $expected = new Category($id, $name, $createdAt);

        $this->assertEquals($expected, $this->sut->__invoke($id, $name, $createdAt));
    }
}
