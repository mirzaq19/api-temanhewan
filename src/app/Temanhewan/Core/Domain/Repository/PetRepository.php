<?php

namespace App\Temanhewan\Core\Domain\Repository;

use App\Temanhewan\Core\Domain\Model\Pet;
use App\Temanhewan\Core\Domain\Model\PetId;
use App\Temanhewan\Core\Domain\Model\UserId;

interface PetRepository
{
    public function byId(PetId $id): ?Pet;
    public function listPet(UserId $userId,int $offset, int $limit): array;
    public function save(Pet $pet): void;
    public function update(Pet $pet): void;
    public function delete(Pet $pet): void;
}
