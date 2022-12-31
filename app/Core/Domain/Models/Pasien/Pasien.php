<?php

namespace App\Core\Domain\Models\Pasien;

use Exception;
use App\Core\Domain\Models\Email;
use App\Exceptions\PasienException;
use Illuminate\Support\Facades\Hash;

class Pasien
{
    private PasienId $id;
    private string $name;
    private string $no_telp;
    private string $alamat;
    private string $foto;

    /**
     * @param PasienId $id
     * @param string $name
     * @param string $no_telp
     * @param string $alamat
     * @param string $foto
     */
    public function __construct(PasienId $id, string $name, string $no_telp, string $alamat, string $foto)
    {
        $this->id = $id;
        $this->name = $name;
        $this->no_telp = $no_telp;
        $this->alamat = $alamat;
        $this->foto = $foto;
    }

    /**
     * @throws Exception
     */
    public static function create(PasienId $id, string $name, string $no_telp, string $alamat, string $foto): self
    {
        return new self(
            $id,
            $name,
            $no_telp,
            $alamat,
            $foto,
        );
    }

    /**
     * @return PasienId
     */
    public function getId(): PasienId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAlamat(): string
    {
        return $this->alamat;
    }

    /**
     * @return string
     */
    public function getNoTelp(): string
    {
        return $this->no_telp;
    }

    /**
     * @return string
     */
    public function getFoto(): string
    {
        return $this->foto;
    }
}
