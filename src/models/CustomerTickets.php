<?php

namespace src\models;

class CustomerTickets
{
    private $customerTickets;

    public function __construct()
    {
        $this->customerTickets = $this->loadCustomerTickets();
    }

    private function loadCustomerTickets(): array
    {
        try {
            $jsonData = file_get_contents(__DIR__ . '/../data/customerTickets.json');
        } catch (\Exception $e) {
            throw new \Exception("Error loading data");
        }

        return json_decode($jsonData, true);
    }

    public function getCustomerTickets(): array
    {
        return $this->customerTickets;
    }

}
