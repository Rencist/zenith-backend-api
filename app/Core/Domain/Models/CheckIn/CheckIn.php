<?php

namespace App\Core\Domain\Models\CheckIn;

use Exception;
use App\Core\Domain\Models\CheckIn\CheckInId;

class CheckIn
{
    private CheckInId $id;
    private string $penyakit;

    /**
     * @param CheckInId $id
     * @param string $penyakit
     */
    public function __construct(CheckInId $id, string $penyakit)
    {
        $this->id = $id;
        $this->penyakit = $penyakit;
    }

    /**
     * @throws Exception
     */
    public static function create(string $penyakit): self
    {
        return new self(
            CheckInId::generate(),
            $penyakit,
        );
    }

    /**
     * @return CheckInId
     */
    public function getId(): CheckInId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPenyakit(): string
    {
        return $this->penyakit;
    }
}
