<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Models\Gejala\Gejala;
use App\Core\Domain\Models\Gejala\GejalaId;

interface GejalaRepositoryInterface
{
    public function persist(Gejala $Gejala): void;

    public function find(GejalaId $id): ?Gejala;

    public function findByName(string $gejala_name): ?Gejala;

    public function getAll(): array;
}
