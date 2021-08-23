<?php

declare(strict_types=1);

namespace AvailabilityBundle\Service;

use AvailabilityBundle\Enum\RedisKeyEnum;
use Predis\ClientInterface;

class RedisService
{
    public function __construct(
        private ClientInterface $redisClient,
    ) { }

    public function isQueueAvailable(string $city): bool
    {
        $isAvailable = $this->redisClient->get(RedisKeyEnum::IS_AVAILABLE.$city);

        if ($isAvailable === null) {
            $this->redisClient->set(RedisKeyEnum::IS_AVAILABLE, true);
            $isAvailable = true;
        }

        return (bool) $isAvailable;
    }

    public function setAvailableQueue(bool $available, string $city): void
    {
        $this->redisClient->set(RedisKeyEnum::IS_AVAILABLE.$city, $available);
    }

    public function isOpenDate(string $city): bool
    {
        $isAvailable = $this->redisClient->get(RedisKeyEnum::OPEN_DATE.$city);

        if ($isAvailable === null) {
            $this->redisClient->set(RedisKeyEnum::OPEN_DATE.$city, false);
            $isAvailable = false;
        }

        return (bool) $isAvailable;
    }

    public function setOpenDate(bool $available, string $city): void
    {
        $this->redisClient->set(RedisKeyEnum::OPEN_DATE.$city, $available);
    }
}
