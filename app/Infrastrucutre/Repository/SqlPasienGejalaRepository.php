<?php

namespace App\Infrastrucutre\Repository;

use App\Core\Domain\Models\CheckIn\CheckInId;
use App\Core\Domain\Models\Gejala\GejalaId;
use App\Core\Domain\Models\PasienGejala\PasienGejala;
use App\Core\Domain\Models\PasienGejala\PasienGejalaId;
use App\Core\Domain\Repository\PasienGejalaRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class SqlPasienGejalaRepository implements PasienGejalaRepositoryInterface
{
    public function persist(PasienGejala $pasien_gejala): void
    {
        DB::table('pasien_gejala')->upsert([
            'id' => $pasien_gejala->getId()->toString(),
            'check_in_id' => $pasien_gejala->getCheckInId()->toString(),
            'gejala_id' => $pasien_gejala->getGejalaId()->toString(),
        ], 'id');
    }

    /**
     * @throws Exception
     */
    public function find(PasienGejalaId $id): ?PasienGejala
    {
        $row = DB::table('pasien_gejala')->where('id', $id->toString())->first();

        if (!$row) return null;

        return $this->constructFromRows($row[0]);
    }

    /**
     * @throws Exception
     */
    public function getAll(): array
    {
        $rows = DB::table('pasien_gejala')->get();

        return $this->constructFromRows($rows->all());
    }
    
    /**
     * @param array $rows
     * @return pasien_gejala[]
     * @throws Exception
     */
    public function constructFromRows(array $rows): array
    {
        $pasien_gejala = [];
        foreach ($rows as $row) {
            $pasien_gejala[] = new
            PasienGejala(
                new PasienGejalaId($row->id),
                new CheckInId($row->check_in_id),
                new GejalaId($row->gejala_id),
            );
        }
        return $pasien_gejala;
    }
}
