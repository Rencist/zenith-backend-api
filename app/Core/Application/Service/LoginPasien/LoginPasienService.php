<?php

namespace App\Core\Application\Service\LoginPasien;

use Exception;
use App\Core\Domain\Models\Email;
use App\Core\Domain\Repository\PasienRepositoryInterface;
use App\Exceptions\ZenithException;
use App\Core\Domain\Service\JwtManagerInterface;

class LoginPasienService
{
    private PasienRepositoryInterface $pasien_repository;
    private JwtManagerInterface $jwt_factory;

    /**
     * @param PasienRepositoryInterface $pasien_repository
     * @param JwtManagerInterface $jwt_factory
     */
    public function __construct(PasienRepositoryInterface $pasien_repository, JwtManagerInterface $jwt_factory)
    {
        $this->pasien_repository = $pasien_repository;
        $this->jwt_factory = $jwt_factory;
    }

    /**
     * @throws Exception
     */
    public function execute(LoginPasienRequest $request): LoginPasienResponse
    {
        $pasien = $this->pasien_repository->findByNoTelp($request->getNoTelp());
        if (!$pasien) {
            ZenithException::throw("pasien tidak ditemukan", 1006, 404);
        }
        $type = $pasien->getType();
        
        $pasien->beginVerification()
            ->checkPassword($request->getPassword())
            ->verify();
        $token_jwt = $this->jwt_factory->createFromUser($pasien);
        return new LoginPasienResponse($token_jwt, $type);
    }
}
