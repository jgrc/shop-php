<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Common\Bus;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

interface Event
{
    public function id(): Uuid;
    public function when(): DateTimeImmutable;
    /** @return mixed[] */
    public function payload(): array;
    public static function name(): string;
    /** @param mixed[] $payload */
    public static function from(Uuid $id, DateTimeImmutable $when, array $payload): static;
}
