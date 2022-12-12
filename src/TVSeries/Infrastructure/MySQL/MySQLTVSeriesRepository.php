<?php

namespace Oesteve\TVSeries\Infrastructure\MySQL;

use Oesteve\TVSeries\Domain\Model\TVSeries\TVSeries;
use Oesteve\TVSeries\Domain\Model\TVSeries\TVSeriesRepository;

final class MySQLTVSeriesRepository implements TVSeriesRepository
{
    private \mysqli $connection;

    public function __construct(
        string $dbHost,
        string $dbUsername,
        string $dbPassword,
        string $dbName
    ) {
        $mysqli = mysqli_connect(
            $dbHost,
            $dbUsername,
            $dbPassword,
            $dbName
        );

        if (!$mysqli) {
            throw new \Exception('Error when trying to connect to the database');
        }

        $this->connection = $mysqli;
    }

    public function findEpisode(\DateTime $dateTime, ?string $title): ?TVSeries
    {
        $query = 'SELECT * FROM tv_series t LEFT JOIN tv_series_intervals i ON t.id = i.id_tv_series';

        if ($title) {
            $query .= ' WHERE t.title LIKE ?';
        }

        // Set ORDER
        $query .= " ORDER BY nextDatetime(i.week_day, i.show_time, '{$dateTime->format('Y-m-d H:m:s')}') ASC";

        // Limit to one row
        $query .= ' LIMIT 1';

        $stmt = $this->connection->prepare($query);

        if (!$stmt) {
            throw new \RuntimeException('Unexpected statement error');
        }

        if ($title) {
            $titleParam = "%$title%";
            $stmt->bind_param('s', $titleParam);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        if (!$result) {
            throw new \RuntimeException('Unexpected result error');
        }

        if (0 === $result->num_rows) {
            return null;
        }

        $row = $result->fetch_assoc();

        if (null === $row) {
            throw new \RuntimeException('Unexpected result value');
        }

        return TVSeries::fromData($row);
    }

    public function save(TVSeries $episode): void
    {
        // TODO: To be implemented
    }
}
