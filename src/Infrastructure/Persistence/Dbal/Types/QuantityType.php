<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Dbal\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use Jgrc\Shop\Domain\Common\Vo\Quantity;

class QuantityType extends IntegerType
{
    private const NAME = 'quantity_type';

    public function getName(): string
    {
        return self::NAME;
    }

    /** @param ?int $value */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Quantity
    {
        return $value === null ? null : new Quantity($value);
    }

    /** @param ?Quantity $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        return $value?->value();
    }
}
