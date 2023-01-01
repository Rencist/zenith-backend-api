<?php

namespace App\Core\Application\Service\LoginPasien;

class LoginPasienRequest
{
    private string $no_telp;
    private string $password;

    /**
     * @param string $no_telp
     * @param string $password
     */
    public function __construct(string $no_telp, string $password)
    {
        $this->no_telp = $no_telp;
        $this->password = $password;
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
    public function getPassword(): string
    {
        return $this->password;
    }
}
