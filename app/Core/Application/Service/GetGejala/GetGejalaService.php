<?php

namespace App\Core\Application\Service\GetGejala;

use Exception;
use App\Exceptions\UserException;
use App\Core\Domain\Models\Gejala\Gejala;
use App\Core\Domain\Repository\GejalaRepositoryInterface;
use App\Core\Application\Service\GetGejala\GetGejalaResponse;

class GetGejalaService
{
    private GejalaRepositoryInterface $gejala_repository;

    /**
     * @param GejalaRepositoryInterface $gejala_repository
     */
    public function __construct(GejalaRepositoryInterface $gejala_repository)
    {
        $this->gejala_repository = $gejala_repository;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function execute(): array
    {
        $gejala = $this->gejala_repository->getAll();
        if (count($gejala) < 1) {
            UserException::throw("Gejala tidak ditemukan", 1006, 404);
        }
        return array_map(function (Gejala $gejala) {
            return new GetGejalaResponse(
                $gejala->getId()->toString(), 
                $gejala->getName()
            );
        }, $gejala);
    }
}
