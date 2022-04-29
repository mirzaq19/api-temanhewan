<?php

namespace App\Temanhewan\Core\Domain\Model;

use Ramsey\Uuid\Uuid;
use InvalidArgumentException;

class PetId
{
    private string $id;

    public function __construct(string $id = null)
    {
        if (is_null($id)) {
            $this->id = Uuid::uuid4()->toString();
            return;
        }

        if (Uuid::isValid($id)) {
            $this->id = $id;
        } else {
            throw new InvalidArgumentException("Invalid UserId format.",1004);
        }
    }

    public function id() : string
    {
        return $this->id;
    }

    public function equals(PetId $PetId): bool
    {
        return $this->id === $PetId->id;
    }
}
