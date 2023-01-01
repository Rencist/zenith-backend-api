<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Models\PasienGejala\PasienGejala;
use App\Core\Domain\Models\PasienGejala\PasienGejalaId;

interface PasienGejalaRepositoryInterface
{
    public function persist(PasienGejala $pasien_gejala): void;

    public function find(PasienGejalaId $id): ?PasienGejala;

    public function getAll(): array;
}
