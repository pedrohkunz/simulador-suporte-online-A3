<?php

namespace src\models;

class Attendant
{
    private int $id;
    private $remainingTime;

    public function __construct(int $id, $remainingTime)
    {
        $this->id = $id;
        $this->remainingTime = $remainingTime;
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

}
