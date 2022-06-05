<?php

namespace App\Temanhewan\Core\Domain\Model;

use App\Shared\Model\BasicEnum;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;

class GroomingOrderStatus extends BasicEnum
{
    public const PENDING = 'pending';
    public const PAID = 'paid';
    public const CONFIRMED = 'confirmed';
    public const DELIVERED = 'delivered';
    public const REJECTED = 'rejected';
    public const CANCELLED = 'cancelled';
    public const COMPLETED = 'completed';

    /**
     * @throws TemanhewanException
     */
    protected function onErrorException(): TemanhewanException
    {
        throw new TemanhewanException("Invalid GroomingOrderStatus type",1083);
    }
}
