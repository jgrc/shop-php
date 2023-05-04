<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Amqp;

use AMQPChannel;
use AMQPConnection;
use AMQPExchange;
use AMQPQueue;

class AmqpManager
{
    private AMQPConnection $connection;
    private ?AMQPChannel $channel;
    /** @var AMQPQueue[] */
    private array $queues;
    /** @var AMQPExchange[] */
    private array $exchanges;

    public function __construct(string $host, string $vHost, string $login, string $password)
    {
        $this->connection = new AMQPConnection();
        $this->connection->setHost($host);
        $this->connection->setVhost($vHost);
        $this->connection->setLogin($login);
        $this->connection->setPassword($password);
        $this->channel = null;
        $this->queues = [];
        $this->exchanges = [];
    }

    public function createExchange(string $name, string $type, int $flags): void
    {
        $exchange = $this->exchange($name);
        $exchange->setType($type);
        $exchange->setFlags($flags);
        $exchange->declareExchange();
    }

    public function createQueue(string $name, int $flags, ?string $dlExchange, ?string $dlRoutingKey): void
    {
        $queue = $this->queue($name);
        $queue->setFlags($flags);
        if ($dlExchange) {
            $queue->setArgument('x-dead-letter-exchange', $dlExchange);
        }
        if ($dlRoutingKey) {
            $queue->setArgument('x-dead-letter-routing-key', $dlRoutingKey);
        }
        $queue->declareQueue();
    }

    public function createBind(string $queueName, string $exchangeName, ?string $routingKey): void
    {
        $this->queue($queueName)->bind($exchangeName, $routingKey);
    }

    public function publish(
        string $message,
        string $routingKey,
        int $flags,
        string $exchange,
        array $attributes
    ): void {
        $this->exchange($exchange)->publish($message, $routingKey, $flags, $attributes);
    }

    private function queue(string $name): AMQPQueue
    {
        if (!array_key_exists($name, $this->queues)) {
            $queue = new AMQPQueue($this->channel());
            $queue->setName($name);
            $this->queues[$name] = $queue;
        }

        return $this->queues[$name];
    }

    private function exchange(string $name): AMQPExchange
    {
        if (!array_key_exists($name, $this->exchanges)) {
            $exchange = new AMQPExchange($this->channel());
            $exchange->setName($name);
            $this->exchanges[$name] = $exchange;
        }

        return $this->exchanges[$name];
    }

    private function connection(): AMQPConnection
    {
        if (!$this->connection->isConnected()) {
            $this->connection->connect();
        }

        return $this->connection;
    }

    private function channel(): AMQPChannel
    {
        if (!$this->channel) {
            $this->channel = new AMQPChannel($this->connection());
        }

        return $this->channel;
    }
}
