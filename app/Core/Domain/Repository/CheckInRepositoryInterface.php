<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Models\CheckIn\CheckIn;
use App\Core\Domain\Models\CheckIn\CheckInId;
use App\Core\Domain\Models\Pasien\PasienId;

interface CheckInRepositoryInterface
{
    public function persist(CheckIn $check_in): void;

    public function find(CheckInId $id): ?CheckIn;
    
    public function findByPasienId(PasienId $pasien_id): array;

    public function getAll(): array;
}
