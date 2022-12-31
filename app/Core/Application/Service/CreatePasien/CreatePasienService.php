<?php

namespace App\Core\Application\Service\CreatePasien;

use Exception;
use App\Exceptions\ZenithException;
use Illuminate\Support\Facades\Storage;
use App\Core\Domain\Models\Pasien\Pasien;
use App\Core\Domain\Models\Pasien\PasienId;
use App\Core\Domain\Repository\PasienRepositoryInterface;

class CreatePasienService
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
     * @throws Exception
     */
    public function execute(CreatePasienRequest $request)
    {
        if ($request->getFoto()->getSize() > 1048576) {
            ZenithException::throw("foto harus dibawah 1Mb", 2043);
        }

        $pasien_id = PasienId::generate();

        $path = Storage::putFileAs('pasien/foto', $request->getFoto(), $pasien_id->toString());
        if (!$path) {
            ZenithException::throw('gagal menyimpan foto', 2044);
        }

        $pasien = Pasien::create(
            $pasien_id,
            $request->getName(),
            $request->getNoTelp(),
            $request->getAlamat(),
            $path,
        );
        $this->pasien_repository->persist($pasien);
    }
}
