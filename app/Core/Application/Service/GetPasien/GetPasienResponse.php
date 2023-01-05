<?php

namespace App\Core\Application\Service\GetPasien;

use JsonSerializable;

class GetPasienResponse implements JsonSerializable
{
    private string $id;
    private string $name;
    private string $type;
    private string $no_telp;
    private string $alamat;
    private string $foto;

    /**
     * @param string $id
     * @param string $name
     * @param string $type
     * @param string $no_telp
     * @param string $alamat
     * @param string $foto
     */
    public function __construct(string $id, string $name, string $type, string $no_telp, string $alamat, string $foto)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->no_telp = $no_telp;
        $this->alamat = $alamat;
        $this->foto = $foto;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'no_telp' => $this->no_telp,
            'alamat' => $this->alamat,
            'foto' => $this->foto
        ];
    }
}
