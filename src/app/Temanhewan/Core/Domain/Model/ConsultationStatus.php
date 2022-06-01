<?php

namespace App\Temanhewan\Core\Domain\Model;

use App\Shared\Model\BasicEnum;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;

class ConsultationStatus extends BasicEnum
{
    public const PENDING = 'pending';
    public const ACCEPTED = 'accepted';
    public const PAID = 'paid';
    public const REJECTED = 'rejected';
    public const CANCELLED = 'cancelled';
    public const COMPLETED = 'completed';

    /**
     * @throws TemanhewanException
     */
    protected function onErrorException(): TemanhewanException
    {
        throw new TemanhewanException("Invalid consultation status",1038);
    }
}

