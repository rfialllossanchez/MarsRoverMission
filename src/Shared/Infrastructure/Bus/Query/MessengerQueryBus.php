<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Query;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use UnexpectedValueException;

final class MessengerQueryBus implements QueryBus
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->bus = $queryBus;
    }

    public function handle(Query $query): Response
    {
        /** @var HandledStamp $stamp */
        $envelope = $this->bus->dispatch($query);
        $stamp = $envelope->last(HandledStamp::class);
        $result = $stamp?->getResult();

        if (!$result instanceof Response) {
            throw new UnexpectedValueException('Results must be instances of ' . Response::class);
        }

        return $result;
    }
}