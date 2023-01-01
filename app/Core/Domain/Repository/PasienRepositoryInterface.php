<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Models\Pasien\Pasien;
use App\Core\Domain\Models\Pasien\PasienId;

interface PasienRepositoryInterface
{
    public function persist(Pasien $Pasien): void;

    public function find(PasienId $id): ?Pasien;

    public function findByNoTelp(string $no_telp): ?Pasien;

    public function getAll(): array;
}