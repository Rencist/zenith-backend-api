<?php

namespace App\Core\Application\Service\GetPasienDetail;

use App\Core\Domain\Models\Pasien\PasienId;

class GetPasienDetailRequest
{
    private string $pasien_id;

    /**
     * @param string $pasien_id
     */
    public function __construct(string $pasien_id)
    {
        $this->pasien_id = $pasien_id;
    }

    /**
     * @return string
     */
    public function getPasienId(): string
    {
        return $this->pasien_id;
    }
}
