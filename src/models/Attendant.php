<?php

namespace src\models;

class Attendant
{
    private int $id;
    private $remainingTime;
    private ?int $lastEndTime;

    public function __construct(int $id, $remainingTime)
    {
        $this->id = $id;
        $this->remainingTime = $remainingTime;
        $this->lastEndTime = null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRemainingTime()
    {
        return $this->remainingTime;
    }

    public function setRemainingTime($remainingTime): void
    {
        $this->remainingTime = $remainingTime;
    }

    public function isBusy(): bool
    {
        return $this->remainingTime > 0;
    }

    public function getLastEndTime(): ?int
    {
        return $this->lastEndTime;
    }

    public function setLastEndTime(int $time): void
    {
        $this->lastEndTime = $time;
    }

    public function setBusy(bool $busy, int $serviceTime = 0): void
    {
        if ($busy) {
            $this->remainingTime = $serviceTime;
        } else {
            $this->remainingTime = 0;
        }
    }
}
