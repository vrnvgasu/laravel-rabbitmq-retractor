<?php

namespace Vrnvgasu\RebbitMqRetractor\Handlers;

use Exception;
use LogicException;
use Vrnvgasu\RebbitMqRetractor\DTOs\ProducerHandlerDTO;
use Vrnvgasu\RebbitMqRetractor\Helpers\Logger;
use Vrnvgasu\RebbitMqRetractor\Interfaces\Producerable;
use Vrnvgasu\Retractor\Interfaces\Retractable;
use Vrnvgasu\Retractor\Traits\Retractor;

/**
 * Class ProducerHandler
 * @package Vrnvgasu\RebbitMqRetractor\Handlers
 */
class ProducerHandler implements Retractable
{
    use Retractor;
    use Logger;

    protected $retractorAttempt;
    protected $retractorDelay;

    public function __construct()
    {
        $this->retractorAttempt = config('rabbitmq_retractor.attempt', 5);
        $this->retractorDelay = config('rabbitmq_retractor.delay', 5);
    }

    /**
     * @param null $DTO
     * @return bool
     * @throws Exception
     */
    public function tryToProvide($DTO = null): bool
    {
        if (!($DTO instanceof ProducerHandlerDTO)) {
            throw new LogicException(print_r($DTO, true) .  ' must be instance of ' . ProducerHandlerDTO::class);
        }

        if ($this->retractorAttempt > 1) {
            try {
                $this->send($DTO);
            } catch (Exception $e) {
                $this->logError($e);

                return false;
            }
        } else {
            $this->send($DTO);
        }

        return true;
    }

    /**
     * @param ProducerHandlerDTO $DTO
     * @throws Exception
     */
    public function send(ProducerHandlerDTO $DTO): void
    {
        $data = $DTO->toArray();
        $producer = app($data[ProducerHandlerDTO::PRODUCER]);

        if (!($producer instanceof Producerable)) {
            throw new LogicException(print_r($DTO, true) .  ' must be instance of ' . Producerable::class);
        }

        $producer->handle($data[ProducerHandlerDTO::MESSAGE]);
    }
}
