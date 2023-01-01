<?php

namespace App\Core\Domain\Models\PasienGejala;

use App\Core\Domain\Models\CheckIn\CheckIn;
use Exception;
use App\Core\Domain\Models\Gejala\GejalaId;
use App\Core\Domain\Models\PasienGejala\PasienGejalaId;

class PasienGejala
{
    private PasienGejalaId $id;
    private CheckIn $check_in_id;
    private GejalaId $gejala_id;

    /**
     * @param PasienGejalaId $id
     * @param CheckIn $check_in_id
     * @param GejalaId $gejala_id
     */
    public function __construct(PasienGejalaId $id, CheckIn $check_in_id, GejalaId $gejala_id)
    {
        $this->id = $id;
        $this->check_in_id = $check_in_id;
        $this->gejala_id = $gejala_id;
    }

    /**
     * @throws Exception
     */
    public static function create(PasienGejalaId $id, CheckIn $check_in_id, GejalaId $gejala_id): self
    {
        return new self(
            $id,
            $check_in_id,
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
     * @return CheckIn
     */
    public function getCheckInId(): CheckIn
    {
        return $this->check_in_id;
    }

    /**
     * @return GejalaId
     */
    public function getGejalaId(): GejalaId
    {
        return $this->gejala_id;
    }

}
