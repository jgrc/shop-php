<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Common\Service;

use DateTimeImmutable;

interface Clock
{
    public function now(): DateTimeImmutable;
}
