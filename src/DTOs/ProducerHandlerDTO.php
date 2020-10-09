<?php

namespace Vrnvgasu\RebbitMqRetractor\DTOs;

/**
 * Class ProducerHandlerDTO
 * @package Vrnvgasu\RebbitMqRetractor\DTOs
 */
class ProducerHandlerDTO
{
    const PRODUCER = 'producerClass';
    const MESSAGE = 'message';

    /**
     * @var string
     */
    private $producerClass;
    /**
     * @var string
     */
    private $message;

    /**
     * ProducerHandlerDTO constructor.
     * @param string $producerClass
     * @param string $message
     */
    private function __construct(string $producerClass, string $message)
    {
        $this->producerClass = $producerClass;
        $this->message = $message;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        return new static($data[static::PRODUCER], $data[static::MESSAGE]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::PRODUCER => $this->producerClass,
            static::MESSAGE => $this->message,
        ];
    }
}
