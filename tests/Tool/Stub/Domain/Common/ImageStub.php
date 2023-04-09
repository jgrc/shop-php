<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Common;

use Jgrc\Shop\Domain\Common\Vo\Image;
use Jgrc\Shop\Tool\Stub\StringStub;

class ImageStub
{
    public static function random(): Image
    {
        return new Image(StringStub::url());
    }
}
