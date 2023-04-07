<?php

namespace Jgrc\Shop\Infrastructure\Persistence\Dbal\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Jgrc\Shop\Domain\Common\Vo\Image;

class ImageType extends StringType
{
    private const NAME = 'name_type';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Image
    {
        return $value === null ? null : new Image($value);
    }

    /** @param ?Image $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value?->value();
    }
}