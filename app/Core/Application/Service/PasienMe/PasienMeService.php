<?php

namespace App\Core\Application\Service\PasienMe;

use Exception;
use App\Exceptions\ZenithException;
use App\Core\Domain\Models\Pasien\Pasien;
use App\Core\Domain\Repository\PasienRepositoryInterface;
use App\Core\Application\Service\PasienMe\PasienMeResponse;
use App\Core\Domain\Models\UserAccount;

class PasienMeService
{
    private PasienRepositoryInterface $pasien_repository;

    /**
     * @param PasienRepositoryInterface $pasien_repository
     */
    public function __construct(PasienRepositoryInterface $pasien_repository)
    {
        $this->pasien_repository = $pasien_repository;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function execute(UserAccount $account): PasienMeResponse
    {
        $pasien = $this->pasien_repository->find($account->getPasienId());
        if (!$pasien) {
            ZenithException::throw("Pasien tidak ditemukan", 1006, 404);
        }
        return new PasienMeResponse(
            $pasien->getId()->toString(), 
            $pasien->getName(),
            $pasien->getType()->value,
            $pasien->getNoTelp(),
            $pasien->getAlamat(),
            $pasien->getFoto(),
        );
    }
}
