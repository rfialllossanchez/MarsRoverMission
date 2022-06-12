<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Query;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use UnexpectedValueException;

final class SymfonyQueryBus implements QueryBus
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->bus = $queryBus;
    }

    public function ask(Query $query): Response
    {
        try {
            /** @var HandledStamp $stamp */
            $envelope = $this->bus->dispatch($query);
            $stamp = $envelope->last(HandledStamp::class);
            $result = $stamp?->getResult();
        } catch (HandlerFailedException $receivedException) {
            $unwrappedException = $receivedException;
            while ($unwrappedException instanceof HandlerFailedException) {
                $unwrappedException = $unwrappedException->getPrevious();
            }

            throw $unwrappedException ?? $receivedException;
        }

        if (!$result instanceof Response) {
            throw new UnexpectedValueException('Results must be instances of '.Response::class);
        }

        return $result;
    }
}