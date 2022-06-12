<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Query;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use UnexpectedValueException;

final class SymfonyQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->bus = $queryBus;
    }

    public function handle(Query $query): Response
    {
        $result = $this->handleQuery($query);

        if (!$result instanceof Response) {
            throw new UnexpectedValueException('Results must be instances of ' . Response::class);
        }

        return $result;
    }
}