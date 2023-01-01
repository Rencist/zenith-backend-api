<?php

namespace App\Core\Application\Service\CreatePasien;

use Illuminate\Http\UploadedFile;

class CreatePasienRequest
{
    private string $name;
    private string $no_telp;
    private string $alamat;
    private UploadedFile $foto;
    private string $password;

    /**
     * @param string $name
     * @param string $no_telp
     * @param string $alamat
     * @param string $foto
     * @param string $password
     */
    public function __construct(string $name, string $no_telp, string $alamat, UploadedFile $foto, string $password)
    {
        $this->name = $name;
        $this->no_telp = $no_telp;
        $this->alamat = $alamat;
        $this->foto = $foto;
        $this->password = $password;
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
     * @return UploadedFile
     */
    public function getFoto(): UploadedFile
    {
        return $this->foto;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
