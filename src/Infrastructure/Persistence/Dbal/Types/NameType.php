<?php

namespace Jgrc\Shop\Infrastructure\Persistence\Dbal\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Jgrc\Shop\Domain\Common\Vo\Name;

class NameType extends StringType
{
    private const NAME = 'name_type';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Name
    {
        return $value === null ? null : new Name($value);
    }

    /** @param ?Name $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value?->value();
    }
}
