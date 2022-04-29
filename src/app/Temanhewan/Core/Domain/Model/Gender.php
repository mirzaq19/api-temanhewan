<?php

namespace App\Temanhewan\Core\Domain\Model;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Shared\Model\BasicEnum;

class Gender extends BasicEnum{
    public const MALE = 'm';
    public const FEMALE = 'f';

    /**
     * @throws TemanhewanException
     */
    protected function onErrorException(): TemanhewanException
    {
        throw new TemanhewanException("Invalid gender type",1001);
    }
}
