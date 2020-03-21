<?php

declare(strict_types=1);

namespace App\ReadModel\JourneyParticipant;

use Doctrine\DBAL\Connection;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class JourneyParticipantFetcher
{
    private Connection $connection;
    private PaginatorInterface $paginator;

    public function __construct(Connection $connection, PaginatorInterface $paginator)
    {
        $this->connection = $connection;
        $this->paginator = $paginator;
    }

    public function all(int $page, int $size, string $sort, string $direction): PaginationInterface
    {
        $qb = $this->connection->createQueryBuilder()
            ->select(
                'jp.id',
                'jp.first_name',
                'jp.last_name',
                'jp.email',
                'jp.expected_price',
                'jp.journey_type',
                'jp.comment'
            )
            ->from('journey_participant', 'jp')
            ->orderBy($sort, $direction === 'desc' ? 'desc' : 'asc');

        return $this->paginator->paginate($qb, $page, $size);
    }
}