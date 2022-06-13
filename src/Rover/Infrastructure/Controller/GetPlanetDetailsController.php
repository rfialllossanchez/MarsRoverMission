<?php

declare(strict_types=1);

namespace App\Rover\Infrastructure\Controller;

use App\Rover\Application\Model\Query\GetPlanetDetailsQuery;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Infrastructure\Controller\BaseController;
use DomainException;
use Psr\Log\LoggerInterface;
use Throwable;

final class GetPlanetDetailsController extends BaseController
{
    public function __construct(
        protected QueryBus $queryBus,
        protected CommandBus $commandBus,
        protected LoggerInterface $logger
    )
    {
        parent::__construct($queryBus, $commandBus, $logger);
    }

    public function __invoke(): ?Response
    {
        try {
            return $this->queryBus->handle(
                new GetPlanetDetailsQuery()
            );
        } catch (DomainException $domainException) {
            $this->logger->error(
                'A domain exception was launched when trying to retrieve planet details.',
                [
                    'message' => $domainException->getMessage(),
                    'exception' => $domainException,
                ]
            );
        } catch (Throwable $throwable) {
            $this->logger->error(
                'An error happened when trying to retrieve planet details.',
                [
                    'message' => $throwable->getMessage(),
                    'exception' => $throwable,
                ]
            );
        }

        return null;
    }

}