<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Dbal\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Jgrc\Shop\Domain\Common\Vo\Email;

class EmailType extends StringType
{
    private const NAME = 'name_type';

    public function getName(): string
    {
        return self::NAME;
    }

    /** @param ?string $value */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Email
    {
        return $value === null ? null : new Email($value);
    }

    /** @param ?Email $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value?->value();
    }
}
