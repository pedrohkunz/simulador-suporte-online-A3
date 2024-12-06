<?php

namespace src\models;

use src\factories\AttendantFactory;
use src\models\Dataset;

class CustomerServiceSimulator
{
    private Dataset $dataset;
    private array $customerTicketsQueue;
    private array $attendants;
    private float $totalSimulationTime;
    private array $waitTimes;

    public function __construct(int $numberOfAttendants)
    {
        $this->dataset = new Dataset();
        $this->customerTicketsQueue = $this->dataset->getCustomerTickets();

        $this->attendants = AttendantFactory::createAttendants($numberOfAttendants);

        $this->totalSimulationTime = 0;
        $this->waitTimes = [];
    }

    public function runSimulation(): array
    {
        while (count($this->customerTicketsQueue) > 0 || $this->hasBusyAttendants()) {
            $this->processQueue();
            $this->updateAttendants();

            $this->sumTotalSimulationTime(1);
        }

        return [
            'simulationTime' => $this->formatFloatAsMinutesSeconds($this->totalSimulationTime),
            'averageWaitTime' => $this->formatFloatAsMinutesSeconds($this->calculateAverageWaitTime()),
        ];
    }

    private function processQueue(): void
    {
        foreach ($this->customerTicketsQueue as $key => $customerTicket) {
            if ($this->hasAvailableAttendants()) {
                $this->assignCustomerToAttendant($customerTicket);
                unset($this->customerTicketsQueue[$key]);
            } else {
                break;
            }
        }
    }

    private function updateAttendants(): void
    {
        foreach ($this->attendants as $attendant) {
            if ($attendant->isBusy()) {
                $attendant->setRemainingTime($attendant->getRemainingTime() - 1);
    
                if ($attendant->getRemainingTime() <= 0) {
                    $attendant->setBusy(false);
                }
            }
        }
    }

    private function assignCustomerToAttendant(array $customerTicket): void
    {
        foreach ($this->attendants as $attendant) {
            if (!$attendant->isBusy()) {
                $waitTime = max(0, $this->totalSimulationTime - $customerTicket['arrivalTime']);
                $this->waitTimes[] = $waitTime;
    
                $attendant->setBusy(true, $customerTicket['serviceTime']);
                $attendant->setRemainingTime($customerTicket['serviceTime']);
                $attendant->setLastEndTime($this->totalSimulationTime + $customerTicket['serviceTime']);
                return;
            }
        }
    }

    private function calculateAverageWaitTime(): float
    {
        return count($this->waitTimes) > 0 ? array_sum($this->waitTimes) / count($this->waitTimes) : 0;
    }

    private function sumTotalSimulationTime($value): void
    {
        $this->totalSimulationTime += $value;
    }

    private function hasBusyAttendants(): bool
    {
        foreach ($this->attendants as $attendant) {
            if ($attendant->isBusy()) {
                return true;
            }
        }
        return false;
    }

    private function hasAvailableAttendants(): bool
    {
        foreach ($this->attendants as $attendant) {
            if (!$attendant->isBusy()) {
                return true;
            }
        }
        return false;
    }

    private function formatFloatAsMinutesSeconds(float $timeInSeconds): string
    {
        $minutes = (int)floor($timeInSeconds / 60);
        $seconds = (int)round($timeInSeconds % 60);

        return sprintf('%d:%02d', $minutes, $seconds);
    }
}
