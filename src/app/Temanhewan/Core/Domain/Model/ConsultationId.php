<?php

namespace App\Temanhewan\Core\Domain\Model;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class ConsultationId
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
            throw new InvalidArgumentException("Invalid ConsultationId format.",1035);
        }
    }

    public function id(): string
    {
        return $this->id;
    }

    public function equals(ConsultationId $consultationId): bool
    {
        return $this->id === $consultationId->id;
    }
}
