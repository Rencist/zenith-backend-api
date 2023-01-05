<?php

namespace App\Core\Domain\Models\CheckIn;

use Exception;
use App\Core\Domain\Models\CheckIn\CheckInId;
use App\Core\Domain\Models\Pasien\PasienId;

class CheckIn
{
    private CheckInId $id;
    private PasienId $pasien_id;
    private string $penyakit;

    /**
     * @param CheckInId $id
     * @param PasienId $pasien_id
     * @param string $penyakit
     */
    public function __construct(CheckInId $id, PasienId $pasien_id, string $penyakit)
    {
        $this->id = $id;
        $this->pasien_id = $pasien_id;
        $this->penyakit = $penyakit;
    }

    /**
     * @throws Exception
     */
    public static function create(string $penyakit, PasienId $pasien_id): self
    {
        return new self(
            CheckInId::generate(),
            $pasien_id,
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
     * @return PasienId
     */
    public function getPasienId(): PasienId
    {
        return $this->pasien_id;
    }

    /**
     * @return string
     */
    public function getPenyakit(): string
    {
        return $this->penyakit;
    }
}
