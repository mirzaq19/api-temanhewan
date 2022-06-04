<?php

namespace App\Temanhewan\Core\Domain\Repository;

use App\Temanhewan\Core\Domain\Model\GroomingService;
use App\Temanhewan\Core\Domain\Model\GroomingServiceId;
use App\Temanhewan\Core\Domain\Model\UserId;

interface GroomingServiceRepository
{
    public function ById(GroomingServiceId $groomingServiceId): ?GroomingService;
    public function list(UserId $groomingId, int $offset, int $limit): array;
    public function save(GroomingService $groomingService): void;
    public function update(GroomingService $groomingService): void;
    public function delete(GroomingService $groomingService): void;
}
