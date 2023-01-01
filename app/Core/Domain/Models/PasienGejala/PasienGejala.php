<?php

namespace App\Core\Domain\Models\PasienGejala;

use Exception;
use App\Core\Domain\Models\Email;
use App\Core\Domain\Models\Gejala\GejalaId;
use App\Core\Domain\Models\Pasien\PasienId;
use App\Exceptions\PasienGejalaException;
use Illuminate\Support\Facades\Hash;

class PasienGejala
{
    private PasienGejalaId $id;
    private PasienId $pasien_id;
    private GejalaId $gejala_id;

    /**
     * @param PasienGejalaId $id
     * @param PasienId $pasien_id
     * @param GejalaId $gejala_id
     */
    public function __construct(PasienGejalaId $id, PasienId $pasien_id, GejalaId $gejala_id)
    {
        $this->id = $id;
        $this->pasien_id = $pasien_id;
        $this->gejala_id = $gejala_id;
    }

    /**
     * @throws Exception
     */
    public static function create(PasienGejalaId $id, PasienId $pasien_id, GejalaId $gejala_id): self
    {
        return new self(
            $id,
            $pasien_id,
            $gejala_id
        );
    }

    /**
     * @return PasienGejalaId
     */
    public function getId(): PasienGejalaId
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
     * @return GejalaId
     */
    public function getGejalaId(): GejalaId
    {
        return $this->gejala_id;
    }

}
