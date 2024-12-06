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
    private array $idleTimes;

    public function __construct(int $numberOfAttendants)
    {
        $this->dataset = new Dataset();
        $this->customerTicketsQueue = $this->dataset->getCustomerTickets();

        $this->attendants = AttendantFactory::createAttendants($numberOfAttendants);

        $this->waitTimes = [];
        $this->idleTimes = [];
    }

    public function runSimulation(): array
    {
        while (count($this->customerTicketsQueue) > 0 || $this->hasBusyAttendants()) {
            $this->updateAttendants();
            $this->addNewCustomers();
        }

        $this->setTotalSimulationTime();

        return [
            'simulationTime' => $this->formatFloatAsMinutesSeconds($this->totalSimulationTime),
            'averageidleTime' => $this->formatFloatAsMinutesSeconds($this->calculateAverageIdleTime()),
            'averageWaitTime' => $this->formatFloatAsMinutesSeconds($this->calculateAverageWaitTime())
        ];
    }

    private function updateAttendants(): void
    {
        foreach ($this->attendants as $attendant) {
            if ($attendant->isBusy()) {
                $attendant->setRemainingTime($attendant->getRemainingTime() - 1);
            }
        }
    }

    private function addNewCustomers(): void
    {
        foreach ($this->customerTicketsQueue as $key => $customerTicket) {
            $this->assignCustomerToAttendant($customerTicket);

            $this->addWaitTimeAndIddleTime($customerTicket);

            unset($this->customerTicketsQueue[$key]);
            
        }
    }

    private function addWaitTimeAndIddleTime(array $customerTicket): float
    {
        if ($this->hasAvailableAttendants()) {
            $this->waitTimes[] = 0;
        }
        
        $attendant = $this->getAttendantWithLeastWaitTime();

        if ($attendant->getRemainingTime() < $customerTicket['arrivalTime']) {
            $this->waitTimes[] = 0;
            $this->idleTimes[] = $customerTicket['arrivalTime'] - $attendant->getRemainingTime();
        }

        return $attendant->getRemainingTime() - $customerTicket['arrivalTime'];
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

    private function getAttendantWithLeastWaitTime(): Attendant
    {
        $attendantWithLeastWaitTime = $this->attendants[0];
        foreach ($this->attendants as $attendant) {
            if ($attendant->getRemainingTime() < $attendantWithLeastWaitTime->getRemainingTime()) {
                $attendantWithLeastWaitTime = $attendant;
            }
        }

        return $attendantWithLeastWaitTime;
    }

    private function assignCustomerToAttendant(array $customerTicket): void
    {
        foreach ($this->attendants as $attendant) {
            if (!$attendant->isBusy()) {
                $attendant->setRemainingTime($customerTicket['serviceTime']);
                return;
            }
        }
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

    private function calculateAverageIdleTime(): float
    {
        return array_sum($this->idleTimes) / count($this->idleTimes);
    }

    private function calculateAverageWaitTime(): float
    {
        return array_sum($this->waitTimes) / count($this->waitTimes);
    }

    private function setTotalSimulationTime()
    {
        $originalData = $this->dataset->getCustomerTickets();
        $serviceTimes = array_column($originalData, 'serviceTime');

        $this->totalSimulationTime = array_sum($serviceTimes) + array_sum($this->idleTimes) + array_sum($this->waitTimes);
    }

    function formatFloatAsMinutesSeconds(float $timeInSeconds): string
    {
        $minutes = floor($timeInSeconds / 60);
        $seconds = round($timeInSeconds % 60);
        
        return sprintf('%d:%02d', $minutes, $seconds);
    }

}