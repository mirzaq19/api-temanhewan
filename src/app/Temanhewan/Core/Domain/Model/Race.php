<?php

namespace App\Temanhewan\Core\Domain\Model;

use App\Shared\Model\BasicEnum;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;

class Race extends BasicEnum{
    public const DOG = 'dog';
    public const CAT = 'cat';

    /**
     * @throws TemanhewanException
     */
    protected function onErrorException(): TemanhewanException
    {
        throw new TemanhewanException("Invalid race pet type",1002);
    }
}
