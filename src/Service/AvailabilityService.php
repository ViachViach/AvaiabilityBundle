<?php

declare(strict_types=1);

namespace AvailabilityBundle\Service;

class AvailabilityService implements AvailabilityInterface
{
    public function __construct(
        private RedisService $redisService,
    ) { }

    public function isAvailable(string $cityCode): void
    {
        while (true) {
            $isAvailable = $this->redisService->isQueueAvailable($cityCode);
            if ($isAvailable) {
                $this->redisService->setAvailableQueue(false, $cityCode);
                return;
            }

            sleep(1);
        }
    }

    public function isOpenDate(string $cityCode): void
    {
        while (true) {
            $isAvailable = $this->redisService->isOpenDate($cityCode);
            if ($isAvailable) {
                return;
            }

            sleep(1);
        }
    }
}
