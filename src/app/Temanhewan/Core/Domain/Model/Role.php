<?php

namespace App\Temanhewan\Core\Domain\Model;

use App\Shared\Model\BasicEnum;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;

class Role extends BasicEnum
{
    public const CUSTOMER = 'customer';
    public const DOCTOR = 'doctor';
    public const GROOMING = 'grooming';

    /**
     * @throws TemanhewanException
     */
    protected function onErrorException(): TemanhewanException
    {
        throw new TemanhewanException("Invalid role type",1000);
    }
}
