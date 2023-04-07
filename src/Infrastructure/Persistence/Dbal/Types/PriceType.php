<?php

namespace Jgrc\Shop\Infrastructure\Persistence\Dbal\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use Jgrc\Shop\Domain\Common\Vo\Price;

class PriceType extends IntegerType
{
    private const NAME = 'price_type';

    public function getName(): string
    {
        return self::NAME;
    }

    /** @param ?int $value */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Price
    {
        return $value === null ? null : new Price($value);
    }

    /** @param ?Price $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        return $value?->value();
    }
}
