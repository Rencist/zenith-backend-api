<?php

namespace App\Core\Application\Service\GetPasien;

use Exception;
use App\Exceptions\ZenithException;
use App\Core\Domain\Models\Pasien\Pasien;
use App\Core\Domain\Repository\PasienRepositoryInterface;
use App\Core\Application\Service\GetPasien\GetPasienResponse;

class GetPasienService
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
    public function execute(): array
    {
        $pasien = $this->pasien_repository->getAll();
        if (count($pasien) < 1) {
            ZenithException::throw("Pasien tidak ditemukan", 1006, 404);
        }
        return array_map(function (Pasien $pasien) {
            return new GetPasienResponse(
                $pasien->getId()->toString(), 
                $pasien->getName(),
                $pasien->getType()->value,
                $pasien->getNoTelp(),
                $pasien->getAlamat(),
                $pasien->getFoto(),
            );
        }, $pasien);
    }
}
