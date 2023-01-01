<?php

namespace App\Infrastrucutre\Repository;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Core\Domain\Models\Pasien\Pasien;
use App\Core\Domain\Models\User\UserType;
use App\Core\Domain\Models\Pasien\PasienId;
use App\Core\Domain\Repository\PasienRepositoryInterface;

class SqlPasienRepository implements PasienRepositoryInterface
{
    public function persist(Pasien $pasien): void
    {
        DB::table('pasien')->upsert([
            'id' => $pasien->getId()->toString(),
            'user_type' => $pasien->getType()->value,
            'name' => $pasien->getName(),
            'no_telp' => $pasien->getNoTelp(),
            'alamat' => $pasien->getAlamat(),
            'foto' => $pasien->getFoto(),
            'password' => $pasien->getHashedPassword()

        ], 'id');
    }

    /**
     * @throws Exception
     */
    public function find(PasienId $id): ?Pasien
    {
        $row = DB::table('pasien')->where('id', $id->toString())->first();

        if (!$row) return null;

        return $this->constructFromRows([$row])[0];
    }

    /**
     * @throws Exception
     */
    public function findByNoTelp(string $no_telp): ?Pasien
    {
        $row = DB::table('pasien')->where('no_telp', $no_telp)->first();

        if (!$row) return null;

        return $this->constructFromRows([$row])[0];
    }

    /**
     * @throws Exception
     */
    public function getAll(): array
    {
        $rows = DB::table('pasien')->get();

        return $this->constructFromRows($rows->all());
    }
    
    /**
     * @param array $rows
     * @return pasien[]
     * @throws Exception
     */
    public function constructFromRows(array $rows): array
    {
        $pasien = [];
        foreach ($rows as $row) {
            $pasien[] = new
            Pasien(
                new PasienId($row->id),
                UserType::from($row->user_type),
                $row->name,
                $row->no_telp,
                $row->alamat,
                $row->foto,
                $row->password,
            );
        }
        return $pasien;
    }
}
