<?php

namespace Vrnvgasu\RebbitMqRetractor\Handlers;

use Symfony\Component\Mime\Exception\LogicException;
use Vrnvgasu\RebbitMqRetractor\Exceptions\RetractConsumerException;
use Vrnvgasu\RebbitMqRetractor\Helpers\Logger;
use Vrnvgasu\Retractor\Interfaces\Retractable;
use Vrnvgasu\Retractor\Traits\Retractor;

/**
 * Class ConsumerHandler
 * @package Vrnvgasu\RebbitMqRetractor\Handlers
 */
abstract class ConsumerHandler implements Retractable
{
    use Retractor;
    use Logger;

    /**
     * @var int
     */
    protected $retractorAttempt;
    /**
     * @var int
     */
    protected $retractorDelay;

    /**
     * ConsumerHandler constructor.
     */
    public function __construct()
    {
        $this->retractorAttempt = config('rabbitmq_retractor.attempt', 5);
        $this->retractorDelay = config('rabbitmq_retractor.delay', 5);

        if (!is_integer($this->retractorAttempt)) {
            throw new LogicException('Attempt must be integer.');
        }
        if (!is_integer($this->retractorDelay)) {
            throw new LogicException('Delay must be integer.');
        }
    }

    /**
     * @param null $data
     * @return bool
     */
    public function tryToProvide($data = null): bool
    {
        if ($this->retractorAttempt > 1) {
            try {
                $this->processRabbitMessage($data);
            } catch (RetractConsumerException $e) {
                $this->logError($e);

                return false;
            }
        } else {
            $this->processRabbitMessage($data);
        }

        return true;
    }

    abstract protected function processRabbitMessage($data);
}
