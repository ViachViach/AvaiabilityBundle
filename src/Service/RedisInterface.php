<?php

declare(strict_types=1);

namespace AvailabilityBundle\Service;

interface RedisInterface
{
    public function isQueueAvailable(string $city): bool;
    public function setAvailableQueue(bool $available, string $city): void;
    public function isOpenDate(string $city): bool;
    public function setOpenDate(bool $available, string $city): void;
}
