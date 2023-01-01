<?php

namespace App\Core\Domain\Models;

use App\Core\Domain\Models\Pasien\PasienId;
use App\Core\Domain\Models\User\UserId;

class UserAccount
{
    private UserId $user_id;
    private PasienId $pasien_id;

    /**
     * @param UserId $user_id
     * @param PasienId $pasien_id
     */
    public function __construct(UserId $user_id, PasienId $pasien_id)
    {
        $this->user_id = $user_id;
        $this->user_id = $pasien_id;
    }

    /**
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->user_id;
    }

    /**
     * @return PasienId
     */
    public function getPasienId(): PasienId
    {
        return $this->pasien_id;
    }

}
