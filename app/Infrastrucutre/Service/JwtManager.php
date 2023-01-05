<?php

namespace App\Infrastrucutre\Service;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use UnexpectedValueException;
use Firebase\JWT\ExpiredException;
use App\Exceptions\ZenithException;
use App\Core\Domain\Models\User\User;
use App\Core\Domain\Models\User\UserId;
use App\Core\Domain\Models\UserAccount;
use App\Core\Domain\Models\Pasien\Pasien;
use App\Core\Domain\Models\Pasien\PasienId;
use App\Core\Domain\Repository\PasienRepositoryInterface;
use Firebase\JWT\SignatureInvalidException;
use App\Core\Domain\Service\JwtManagerInterface;
use App\Core\Domain\Repository\UserRepositoryInterface;

class JwtManager implements JwtManagerInterface
{
    public UserRepositoryInterface $user_repository;
    public PasienRepositoryInterface $pasien_repository;

    /**
     * @param UserRepositoryInterface $user_repository
     * @param PasienRepositoryInterface $pasien_repository
     */
    public function __construct(UserRepositoryInterface $user_repository, PasienRepositoryInterface $pasien_repository)
    {
        $this->user_repository = $user_repository;
        $this->pasien_repository = $pasien_repository;
    }


    public function createFromUser(User $user): string
    {
        return JWT::encode(
            [
                'user_id' => $user->getId()->toString()
            ],
            config('app.key'),
            'HS256'
        );
    }

    public function createFromPasien(Pasien $pasien): string
    {
        return JWT::encode(
            [
                'pasien_id' => $pasien->getId()->toString()
            ],
            config('app.key'),
            'HS256'
        );
    }

    /**
     * @throws Exception
     */
    public function decode(string $jwt): UserAccount
    {
        try {
            $jwt = JWT::decode(
                $jwt,
                new Key(config('app.key'), 'HS256')
            );
        } catch (ExpiredException $e) {
            ZenithException::throw('JWT has expired', 902);
        } catch (SignatureInvalidException $e) {
            ZenithException::throw('JWT signature is invalid', 903);
        } catch (UnexpectedValueException $e) {
            ZenithException::throw('Unexpected JWT format', 907);
        }
        // $user = $this->user_repository->find(new UserId($jwt->pasien_id));
        $pasien = $this->pasien_repository->find(new PasienId($jwt->pasien_id));
        // if (!$user) {
        //     ZenithException::throw("User not found!", 1500);
        // }
        if (!$pasien) {
            ZenithException::throw("Pasien not found!", 1500);
        }
        return new UserAccount(
            new UserId($jwt->pasien_id),
            new PasienId($jwt->pasien_id)
        );
    }
}