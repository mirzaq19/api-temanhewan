<?php

namespace App\Shared\Model;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use ReflectionClass;

abstract class BasicEnum
{
    /**
     * @var string
     */
    protected string $value;

    /**
     * TemanhewanEnum constructor.
     * @param string $value
     * @throws TemanhewanException
     */
    public function __construct(string $value)
    {
        $reflection = new ReflectionClass(static::class);
        foreach ($reflection->getConstants() as $key => $val) {
            if ($value == $val) {
                $this->value = $value;
            }
        }

        if (!isset($this->value)) {
            throw $this->onErrorException();
        }
    }

    abstract protected function onErrorException(): TemanhewanException;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
