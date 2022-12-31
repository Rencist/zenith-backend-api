<?php

namespace App\Core\Application\Service\GetPasienDetail;

use Exception;
use App\Exceptions\ZenithException;
use App\Core\Domain\Models\Pasien\PasienId;
use App\Core\Domain\Repository\PasienRepositoryInterface;
use App\Core\Application\Service\GetPasienDetail\GetPasienDetailResponse;

class GetPasienDetailService
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
     * @return GetPasienDetailResponse
     * @throws Exception
     */
    public function execute(GetPasienDetailRequest $request): GetPasienDetailResponse
    {
        $pasien = $this->pasien_repository->find(new PasienId($request->getPasienId()));
        if (!$pasien) {
            ZenithException::throw("Pasien tidak ditemukan", 1006, 404);
        }
        return new GetPasienDetailResponse(
            $pasien->getId()->toString(), 
            $pasien->getName(),
            $pasien->getNoTelp(),
            $pasien->getAlamat(),
            $pasien->getFoto(),
        );
    }
}
