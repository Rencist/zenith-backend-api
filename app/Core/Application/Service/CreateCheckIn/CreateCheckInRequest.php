<?php

namespace App\Core\Application\Service\CreateCheckIn;

class CreateCheckInRequest
{
    private string $gejala;

    /**
     * @param string $gejala
     */
    public function __construct(string $gejala)
    {
        $this->gejala = $gejala;
    }

    /**
     * @return string
     */
    public function getGejala(): string
    {
        return $this->gejala;
    }
}
