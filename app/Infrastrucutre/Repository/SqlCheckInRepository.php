<?php

namespace App\Infrastrucutre\Repository;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Core\Domain\Models\CheckIn\CheckIn;
use App\Core\Domain\Models\Pasien\PasienId;
use App\Core\Domain\Models\CheckIn\CheckInId;
use App\Core\Domain\Repository\CheckInRepositoryInterface;

class SqlCheckInRepository implements CheckInRepositoryInterface
{
    public function persist(CheckIn $check_in): void
    {
        DB::table('check_in')->upsert([
            'id' => $check_in->getId()->toString(),
            'penyakit' => $check_in->getPenyakit()
        ], 'id');
    }

    /**
     * @throws Exception
     */
    public function find(CheckInId $id): ?CheckIn
    {
        $row = DB::table('check_in')->where('id', $id->toString())->first();

        if (!$row) return null;

        return $this->constructFromRows([$row])[0];
    }

    /**
     * @throws Exception
     */
    public function findByPasienId(PasienId $pasien_id): array
    {
        $row = DB::table('check_in')->where('pasien_id', $pasien_id->toString())->first();

        if (!$row) return null;

        return $this->constructFromRows([$row]);
    }

    /**
     * @throws Exception
     */
    public function getAll(): array
    {
        $rows = DB::table('check_in')->get();

        return $this->constructFromRows($rows->all());
    }
    
    /**
     * @param array $rows
     * @return CheckIn[]
     * @throws Exception
     */
    public function constructFromRows(array $rows): array
    {
        $check_in = [];
        foreach ($rows as $row) {
            $check_in[] = new
            CheckIn(
                new CheckInId($row->id),
                $row->name,
            );
        }
        return $check_in;
    }
}
