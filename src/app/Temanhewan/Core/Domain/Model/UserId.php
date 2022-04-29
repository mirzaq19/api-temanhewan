<?php

namespace App\Temanhewan\Core\Domain\Model;

use Ramsey\Uuid\Uuid;
use InvalidArgumentException;

class UserId
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
            throw new InvalidArgumentException("Invalid UserId format.",1003);
        }
    }

    public function id(): string
    {
        return $this->id;
    }

    public function equals(UserId $userId): bool
    {
        return $this->id === $userId->id;
    }
}
