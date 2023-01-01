<?php

namespace App\Core\Domain\Models\Pasien;

use Exception;
use App\Exceptions\ZenithException;
use Illuminate\Support\Facades\Hash;
use App\Core\Domain\Models\User\UserType;
use App\Core\Domain\Models\Pasien\PasienId;

class Pasien
{
    private PasienId $id;
    private UserType $type;
    private string $name;
    private string $no_telp;
    private string $alamat;
    private string $foto;
    private string $hashed_password;
    private static bool $verifier = false;

    /**
     * @param PasienId $id
     * @param string $name
     * @param string $no_telp
     * @param string $alamat
     * @param string $foto
     */
    public function __construct(PasienId $id, UserType $type, string $name, string $no_telp, string $alamat, string $foto, string $hashed_password)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->no_telp = $no_telp;
        $this->alamat = $alamat;
        $this->foto = $foto;
        $this->hashed_password = $hashed_password;
    }

    /**
     * @throws Exception
     */
    public static function create(PasienId $id, UserType $type, string $name, string $no_telp, string $alamat, string $foto, string $unhashed_password): self
    {
        return new self(
            $id,
            $type,
            $name,
            $no_telp,
            $alamat,
            $foto,
            Hash::make($unhashed_password)
        );
    }

    /**
     * @return bool
     */
    public static function isVerifier(): bool
    {
        return self::$verifier;
    }

    public function beginVerification(): self
    {
        self::$verifier = true;
        return $this;
    }

    public function checkPassword(string $password): self
    {
        self::$verifier &= Hash::check($password, $this->hashed_password);
        return $this;
    }

    public function checkUserType(UserType $type): self
    {
        self::$verifier &= ($this->type->value == $type->value); 
        return $this;
    }

    /**
     * @throws Exception
     */
    public function verify(): void
    {
        if (!self::$verifier) {
            ZenithException::throw("invalid credential", 1003, 401);
        }
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

    /**
     * @return string
     */
    public function getHashedPassword(): string
    {
        return $this->hashed_password;
    }

    /**
     * @return UserType
     */
    public function getType(): UserType
    {
        return $this->type;
    }
}
