<?php

namespace src\models;

class Data
{
    private $data;

    public function __construct()
    {
        $this->data = $this->loadData();
    }

    private function loadData(): array
    {
        try {
            $jsonData = file_get_contents(__DIR__ . '/../data/data.json');
        } catch (\Exception $e) {
            throw new \Exception("Error loading data");
        }

        $teste = $jsonData;
        return json_decode($jsonData, true);
    }

    public function getData(): array
    {
        return $this->data;
    }

}
