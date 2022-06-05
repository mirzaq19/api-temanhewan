<?php

namespace App\Temanhewan\Core\Domain\Repository;

use App\Temanhewan\Core\Domain\Model\GroomingOrder;
use App\Temanhewan\Core\Domain\Model\GroomingOrderId;
use App\Temanhewan\Core\Domain\Model\PetId;
use App\Temanhewan\Core\Domain\Model\UserId;

interface GroomingOrderRepository
{
    public function byId(GroomingOrderId $id): ?GroomingOrder;
    public function byCustomerId(UserId $customerId, int $offset, int $limit): array;
    public function byGroomingId(UserId $groomingId, int $offset, int $limit): array;
    public function byPetId(PetId $petId, int $offset, int $limit): array;
    public function save(GroomingOrder $groomingOrder): void;
    public function paid(GroomingOrderId $id): void;
    public function cancel(GroomingOrderId $id): void;
    public function confirm(GroomingOrderId $id): void;
    public function deliver(GroomingOrderId $id): void;
    public function reject(GroomingOrderId $id): void;
    public function complete(GroomingOrderId $id): void;
}
