<?php

namespace Vrnvgasu\RebbitMqRetractor\DTOs;

/**
 * Class ProducerHandlerDTO
 * @package Vrnvgasu\RebbitMqRetractor\DTOs
 */
class ProducerHandlerDTO
{
    public const PRODUCER = 'producerClass';
    public const MESSAGE = 'message';

    /**
     * ProducerHandlerDTO constructor.
     */
    private function __construct(private string $producerClass, private string $message)
    {
    }

    public static function fromArray(array $data): self
    {
        return new static($data[static::PRODUCER], $data[static::MESSAGE]);
    }

    public function toArray(): array
    {
        return [
            static::PRODUCER => $this->producerClass,
            static::MESSAGE => $this->message,
        ];
    }
}
