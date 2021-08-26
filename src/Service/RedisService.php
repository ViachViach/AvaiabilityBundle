<?php

declare(strict_types=1);

namespace AvailabilityBundle\Service;

use AvailabilityBundle\Enum\RedisKeyEnum;
use Predis\ClientInterface;

class RedisService implements RedisInterface
{
    public function __construct(
        private ClientInterface $redisClient,
    ) { }

    public function isQueueAvailable(string $city, string $visaType): bool
    {
        $isAvailable = $this->redisClient->get(RedisKeyEnum::IS_AVAILABLE.$city.$visaType);

        if ($isAvailable === null) {
            $this->redisClient->set(RedisKeyEnum::IS_AVAILABLE.$city.$visaType, true);
            $isAvailable = true;
        }

        return (bool) $isAvailable;
    }

    public function setAvailableQueue(bool $available, string $city, string $visaType): void
    {
        $this->redisClient->set(RedisKeyEnum::IS_AVAILABLE.$city.$visaType, $available);
    }

    public function isOpenDate(string $city, string $visaType): bool
    {
        $isAvailable = $this->redisClient->get(RedisKeyEnum::OPEN_DATE.$city.$visaType);

        if ($isAvailable === null) {
            $this->redisClient->set(RedisKeyEnum::OPEN_DATE.$city.$visaType, false);
            $isAvailable = false;
        }

        return (bool) $isAvailable;
    }

    public function setOpenDate(bool $available, string $city, string $visaType): void
    {
        $this->redisClient->set(RedisKeyEnum::OPEN_DATE.$city.$visaType, $available);
    }
}
