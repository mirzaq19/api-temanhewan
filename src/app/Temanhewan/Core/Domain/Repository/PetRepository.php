<?php

namespace App\Temanhewan\Core\Domain\Repository;

use App\Temanhewan\Core\Domain\Model\Pet;
use App\Temanhewan\Core\Domain\Model\PetId;

interface PetRepository
{
    public function byId(PetId $id): ?Pet;
}
