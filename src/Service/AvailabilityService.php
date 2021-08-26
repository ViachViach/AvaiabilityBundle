<?php

declare(strict_types=1);

namespace AvailabilityBundle\Service;

class AvailabilityService implements AvailabilityInterface
{
    public function __construct(
        private RedisService $redisService,
    ) { }

    public function isAvailable(string $cityCode, string $visaType): void
    {
        while (true) {
            $isAvailable = $this->redisService->isQueueAvailable($cityCode, $visaType);
            if ($isAvailable) {
                $this->redisService->setAvailableQueue(false, $cityCode, $visaType);
                return;
            }

            sleep(1);
        }
    }

    public function isOpenDate(string $cityCode, string $visaType): void
    {
        while (true) {
            $isAvailable = $this->redisService->isOpenDate($cityCode, $visaType);
            if ($isAvailable) {
                return;
            }

            sleep(1);
        }
    }
}
