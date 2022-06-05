<?php

namespace App\Temanhewan\Infrastructure\Repository;

use App\Temanhewan\Core\Domain\Model\GroomingOrder;
use App\Temanhewan\Core\Domain\Model\GroomingOrderId;
use App\Temanhewan\Core\Domain\Model\GroomingOrderReview;
use App\Temanhewan\Core\Domain\Model\GroomingOrderStatus;
use App\Temanhewan\Core\Domain\Model\GroomingServiceId;
use App\Temanhewan\Core\Domain\Model\PetId;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;

class SqlGroomingOrderRepository implements GroomingOrderRepository
{
    /**
     * @throws Exception
     */
    public function convertRowToGroomingOrder($grooming_order_row): GroomingOrder
    {
        $grooming_order = new GroomingOrder(
            new GroomingOrderId($grooming_order_row->id),
            $grooming_order_row->address,
            new GroomingOrderStatus($grooming_order_row->status),
            new GroomingServiceId($grooming_order_row->grooming_service_id),
            new PetId($grooming_order_row->pet_id),
            new UserId($grooming_order_row->customer_id),
            new UserId($grooming_order_row->grooming_id),
        );

        $grooming_order->setIsReviewed($grooming_order_row->reviewed);
        $grooming_order->setCreatedAt(new DateTime($grooming_order_row->created_at));
        $grooming_order->setUpdatedAt(new DateTime($grooming_order_row->updated_at));

        return $grooming_order;
    }

    public function saveReview(GroomingOrderReview $groomingOrderReview): void
    {
        DB::table('grooming_reviews')->insert([
            'rating' => $groomingOrderReview->getRating(),
            'review' => $groomingOrderReview->getReview(),
            'is_public' => $groomingOrderReview->isPublic(),
            'customer_id' => $groomingOrderReview->getCustomerId()->id(),
            'grooming_id' => $groomingOrderReview->getGroomingId()->id(),
            'grooming_service_id' => $groomingOrderReview->getGroomingServiceId()->id(),
            'grooming_order_id' => $groomingOrderReview->getGroomingOrderId()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Db::table('grooming_orders')
            ->where('id', $groomingOrderReview->getGroomingOrderId()->id())
            ->update([
                'reviewed' => true,
                'updated_at' => now(),
            ]);
    }

    /**
     * @throws Exception
     */
    public function getReview(GroomingOrderId $groomingOrderId): ?GroomingOrderReview
    {
        $grooming_order_row = DB::table('grooming_reviews')
            ->where('grooming_order_id', $groomingOrderId->id())
            ->first();

        if ($grooming_order_row === null) return null;

        $review =  new GroomingOrderReview(
            $grooming_order_row->rating,
            $grooming_order_row->review,
            $grooming_order_row->is_public,
            new UserId($grooming_order_row->customer_id),
            new UserId($grooming_order_row->grooming_id),
            new GroomingServiceId($grooming_order_row->grooming_service_id),
            new GroomingOrderId($grooming_order_row->grooming_order_id),
        );

        $review->setId($grooming_order_row->id);
        $review->setCreatedAt(new DateTime($grooming_order_row->created_at));
        $review->setUpdatedAt(new DateTime($grooming_order_row->updated_at));

        return $review;
    }

    /**
     * @throws Exception
     */
    public function byId(GroomingOrderId $id): ?GroomingOrder
    {
        $grooming_order_row = DB::table('grooming_orders')
            ->where('id', $id->id())
            ->first();

        if ($grooming_order_row === null) {
            return null;
        }

        return $this->convertRowToGroomingOrder($grooming_order_row);
    }

    /**
     * @throws Exception
     */
    public function byCustomerId(UserId $customerId, int $offset, int $limit): array
    {
        $grooming_order_rows = DB::table('grooming_orders')
            ->where('customer_id', $customerId->id())
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        $grooming_orders = [];
        foreach ($grooming_order_rows as $grooming_order_row) {
            $grooming_orders[] = $this->convertRowToGroomingOrder($grooming_order_row);
        }

        return $grooming_orders;
    }

    /**
     * @throws Exception
     */
    public function byGroomingId(UserId $groomingId, int $offset, int $limit): array
    {
        $grooming_order_rows = DB::table('grooming_orders')
            ->where('grooming_id', $groomingId->id())
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        $grooming_orders = [];
        foreach ($grooming_order_rows as $grooming_order_row) {
            $grooming_orders[] = $this->convertRowToGroomingOrder($grooming_order_row);
        }

        return $grooming_orders;
    }

    /**
     * @throws Exception
     */
    public function byPetId(PetId $petId, int $offset, int $limit): array
    {
        $grooming_order_rows = DB::table('grooming_orders')
            ->where('pet_id', $petId->id())
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        $grooming_orders = [];
        foreach ($grooming_order_rows as $grooming_order_row) {
            $grooming_orders[] = $this->convertRowToGroomingOrder($grooming_order_row);
        }

        return $grooming_orders;
    }

    public function save(GroomingOrder $groomingOrder): void
    {
        DB::table('grooming_orders')
            ->insert([
                'id' => $groomingOrder->getId()->id(),
                'address' => $groomingOrder->getAddress(),
                'status' => $groomingOrder->getStatus()->getValue(),
                'grooming_service_id' => $groomingOrder->getGroomingServiceId()->id(),
                'pet_id' => $groomingOrder->getPetId()->id(),
                'customer_id' => $groomingOrder->getCustomerId()->id(),
                'grooming_id' => $groomingOrder->getGroomingId()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }

    public function paid(GroomingOrderId $id): void
    {
        DB::table('grooming_orders')
            ->where('id', $id->id())
            ->update([
                'status' => GroomingOrderStatus::PAID,
                'updated_at' => now(),
            ]);
    }

    public function cancel(GroomingOrderId $id): void
    {
        DB::table('grooming_orders')
            ->where('id', $id->id())
            ->update([
                'status' => GroomingOrderStatus::CANCELLED,
                'updated_at' => now(),
            ]);
    }

    public function confirm(GroomingOrderId $id): void
    {
        DB::table('grooming_orders')
            ->where('id', $id->id())
            ->update([
                'status' => GroomingOrderStatus::CONFIRMED,
                'updated_at' => now(),
            ]);
    }

    public function deliver(GroomingOrderId $id): void
    {
        DB::table('grooming_orders')
            ->where('id', $id->id())
            ->update([
                'status' => GroomingOrderStatus::DELIVERED,
                'updated_at' => now(),
            ]);
    }

    public function reject(GroomingOrderId $id): void
    {
        DB::table('grooming_orders')
            ->where('id', $id->id())
            ->update([
                'status' => GroomingOrderStatus::REJECTED,
                'updated_at' => now(),
            ]);
    }

    public function complete(GroomingOrderId $id): void
    {
        DB::table('grooming_orders')
            ->where('id', $id->id())
            ->update([
                'status' => GroomingOrderStatus::COMPLETED,
                'updated_at' => now(),
            ]);
    }
}
