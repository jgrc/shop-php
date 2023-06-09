<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Dbal\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class UuidType extends StringType
{
    private const NAME = 'uuid_type';

    public function getName(): string
    {
        return self::NAME;
    }

    /** @param ?string $value */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Uuid
    {
        return $value === null ? null : new Uuid($value);
    }

    /** @param ?Uuid $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value?->value();
    }
}
