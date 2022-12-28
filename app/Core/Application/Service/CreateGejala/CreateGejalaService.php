<?php

namespace App\Core\Application\Service\CreateGejala;

use App\Core\Domain\Models\Gejala\Gejala;
use App\Core\Domain\Repository\GejalaRepositoryInterface;
use Exception;

class CreateGejalaService
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
     * @throws Exception
     */
    public function execute(CreateGejalaRequest $request)
    {
        $Gejala = Gejala::create(
            $request->getName()
        );
        $this->gejala_repository->persist($Gejala);
    }
}
