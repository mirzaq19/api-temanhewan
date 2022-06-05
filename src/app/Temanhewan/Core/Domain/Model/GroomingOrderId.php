<?php

namespace App\Temanhewan\Core\Domain\Model;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class GroomingOrderId
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
            throw new InvalidArgumentException("Invalid GroomingOrderId format.",1081);
        }
    }

    public function id(): string
    {
        return $this->id;
    }

    public function equals(GroomingOrderId $groomingOrderId): bool
    {
        return $this->id === $groomingOrderId->id;
    }
}
