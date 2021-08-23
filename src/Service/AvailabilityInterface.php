<?php

declare(strict_types=1);

namespace AvailabilityBundle\Service;

interface AvailabilityInterface
{
    public function isAvailable(string $cityCode): void;
    public function isOpenDate(string $cityCode): void;
}
