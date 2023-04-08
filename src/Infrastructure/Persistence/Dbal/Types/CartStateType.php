<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Dbal\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use Jgrc\Shop\Domain\Cart\Vo\CartState;

class CartStateType extends IntegerType
{
    private const NAME = 'cart_state';

    public function getName(): string
    {
        return self::NAME;
    }

    /** @param ?int $value */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?CartState
    {
        return $value === null ? null : CartState::from($value);
    }

    /** @param ?CartState $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        return $value?->value;
    }
}
