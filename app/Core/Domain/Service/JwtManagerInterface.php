<?php

namespace App\Core\Domain\Service;

use App\Core\Domain\Models\User\User;
use App\Core\Domain\Models\UserAccount;
use App\Core\Domain\Models\Pasien\Pasien;

interface JwtManagerInterface
{
    public function createFromUser(User $user): string;
    
    public function createFromPasien(Pasien $pasien): string;

    public function decode(string $jwt): UserAccount;
}
