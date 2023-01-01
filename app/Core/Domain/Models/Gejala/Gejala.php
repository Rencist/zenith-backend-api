<?php

namespace App\Core\Domain\Models\Gejala;

use Exception;
use App\Core\Domain\Models\Gejala\GejalaId;

class Gejala
{
    private GejalaId $id;
    private string $name;

    /**
     * @param GejalaId $id
     * @param string $name
     */
    public function __construct(GejalaId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @throws Exception
     */
    public static function create(string $name): self
    {
        return new self(
            GejalaId::generate(),
            $name,
        );
    }

    /**
     * @return GejalaId
     */
    public function getId(): GejalaId
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
}
