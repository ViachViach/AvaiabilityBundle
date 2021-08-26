<?php

declare(strict_types=1);

namespace AvailabilityBundle\Service;

interface RedisInterface
{
    public function isQueueAvailable(string $city, string $visaType): bool;
    public function setAvailableQueue(bool $available, string $city, string $visaType): void;
    public function isOpenDate(string $city, string $visaType): bool;
    public function setOpenDate(bool $available, string $city, string $visaType): void;
}
