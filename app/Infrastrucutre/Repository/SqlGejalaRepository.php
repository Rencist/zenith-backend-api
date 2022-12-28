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

        return $this->constructFromRow($row);
    }

    /**
     * @throws Exception
     */
    private function constructFromRow($row): Gejala
    {
        return new Gejala(
            new GejalaId($row->id),
            $row->name
        );
    }
}
