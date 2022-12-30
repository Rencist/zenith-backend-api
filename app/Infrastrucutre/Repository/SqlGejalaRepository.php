<?php

namespace App\Infrastrucutre\Repository;

use App\Core\Domain\Models\Gejala\Gejala;
use App\Core\Domain\Models\Gejala\GejalaId;
use App\Core\Domain\Repository\GejalaRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class SqlGejalaRepository implements GejalaRepositoryInterface
{
    public function persist(Gejala $gejala): void
    {
        DB::table('gejala')->upsert([
            'id' => $gejala->getId()->toString(),
            'name' => $gejala->getName()
        ], 'id');
    }

    /**
     * @throws Exception
     */
    public function find(GejalaId $id): ?Gejala
    {
        $row = DB::table('gejala')->where('id', $id->toString())->first();

        if (!$row) return null;

        return $this->constructFromRows($row[0]);
    }

    /**
     * @throws Exception
     */
    public function getAll(): array
    {
        $rows = DB::table('gejala')->get();

        return $this->constructFromRows($rows->all());
    }
    
    /**
     * @param array $rows
     * @return Gejala[]
     * @throws Exception
     */
    public function constructFromRows(array $rows): array
    {
        $gejala = [];
        foreach ($rows as $row) {
            $gejala[] = new
            Gejala(
                new GejalaId($row->id),
                $row->name,
            );
        }
        return $gejala;
    }
}
