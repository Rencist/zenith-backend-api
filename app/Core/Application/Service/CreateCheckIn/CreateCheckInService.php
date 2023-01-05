<?php

namespace App\Core\Application\Service\CreateCheckIn;

use Exception;
use App\Core\Domain\Models\UserAccount;
use App\Core\Domain\Models\CheckIn\CheckIn;
use App\Core\Domain\Repository\CheckInRepositoryInterface;
use App\Core\Application\Service\CreateCheckIn\CreateCheckInRequest;
use App\Core\Domain\Models\CheckIn\CheckInId;
use App\Core\Domain\Models\PasienGejala\PasienGejala;
use App\Core\Domain\Repository\GejalaRepositoryInterface;
use App\Core\Domain\Repository\PasienGejalaRepositoryInterface;

class CreateCheckInService
{
    private CheckInRepositoryInterface $check_in_repository;
    private PasienGejalaRepositoryInterface $pasien_gejala_repository;
    private GejalaRepositoryInterface $gejala_repository;

    /**
     * @param CheckInRepositoryInterface $check_in_repository
     * @param PasienGejalaRepositoryInterface $pasien_gejala_repository
     * @param GejalaRepositoryInterface $gejala_repository
     */
    public function __construct(CheckInRepositoryInterface $check_in_repository, PasienGejalaRepositoryInterface $pasien_gejala_repository, GejalaRepositoryInterface $gejala_repository)
    {
        $this->check_in_repository = $check_in_repository;
        $this->pasien_gejala_repository = $pasien_gejala_repository;
        $this->gejala_repository = $gejala_repository;
    }

    /**
     * @throws Exception
     */
    public function execute(array $requests, UserAccount $account, string $penyakit)
    {
        $check_in = CheckIn::create(
            $penyakit,
            $account->getPasienId()
        );
        $this->check_in_repository->persist($check_in);

        foreach ($requests as $request) {
            $gejala = $this->gejala_repository->findByName($request->getGejala());
            $pasien_gejala = PasienGejala::create(
                $check_in->getId(),
                $gejala->getId(),
            );
            $this->pasien_gejala_repository->persist($pasien_gejala);
        }
    }
}
