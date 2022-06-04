<?php

namespace App\Temanhewan\Infrastructure\Repository;

use App\Temanhewan\Core\Domain\Model\GroomingService;
use App\Temanhewan\Core\Domain\Model\GroomingServiceId;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingServiceRepository;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;

class SqlGroomingServiceRepository implements GroomingServiceRepository
{

    /**
     * @throws Exception
     */
    public function convertRowToGroomingService($grooming_service_row): GroomingService
    {
        $grooming_service = new GroomingService(
            new GroomingServiceId($grooming_service_row->id),
            $grooming_service_row->name,
            $grooming_service_row->description,
            $grooming_service_row->price,
            new UserId($grooming_service_row->grooming_id)
        );
        $grooming_service->setCreatedAt(new DateTime($grooming_service_row->created_at));
        $grooming_service->setUpdatedAt(new DateTime($grooming_service_row->updated_at));
        return $grooming_service;
    }

    /**
     * @throws Exception
     */
    public function ById(GroomingServiceId $groomingServiceId): ?GroomingService
    {
        $grooming_service_row = DB::table('grooming_services')
            ->where('id', $groomingServiceId->id())
            ->first();

        if ($grooming_service_row === null) {
            return null;
        }

        return $this->convertRowToGroomingService($grooming_service_row);
    }

    /**
     * @throws Exception
     */
    public function list(UserId $groomingId, int $offset, int $limit): array
    {
        $grooming_services_rows = DB::table('grooming_services')
            ->where('user_id', $groomingId->id())
            ->offset($offset)
            ->limit($limit)
            ->get();

        $grooming_services = [];
        foreach ($grooming_services_rows as $grooming_service_row) {
            $grooming_services[] = $this->convertRowToGroomingService($grooming_service_row);
        }
        return $grooming_services;
    }

    public function save(GroomingService $groomingService): void
    {
        DB::table('grooming_services')->insert([
            'id' => $groomingService->getId()->id(),
            'name' => $groomingService->getName(),
            'description' => $groomingService->getDescription(),
            'price' => $groomingService->getPrice(),
            'grooming_id' => $groomingService->getGroomingId()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function update(GroomingService $groomingService): void
    {
        DB::table('grooming_services')
            ->where('id', $groomingService->getId()->id())
            ->update([
                'name' => $groomingService->getName(),
                'description' => $groomingService->getDescription(),
                'price' => $groomingService->getPrice(),
                'updated_at' => now(),
            ]);
    }

    public function delete(GroomingService $groomingService): void
    {
        DB::table('grooming_services')
            ->where('id', $groomingService->getId()->id())
            ->delete();
    }
}
