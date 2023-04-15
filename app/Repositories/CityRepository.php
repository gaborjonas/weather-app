<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\FindByInterface;
use App\Contracts\GetByIdInterface;
use Illuminate\Database\Connection;

readonly class CityRepository implements FindByInterface, GetByIdInterface
{
    private const TABLE = 'cities';
    public function __construct(private Connection $db)
    {
    }

    /**
     * @param array<int,string> $columns
     * @return array<int,string>
     */
    public function getAll(array $columns): array
    {
        return $this->db
            ->table(self::TABLE)
            ->pluck(...$columns)
            ->toArray();
    }

    /**
     * @param array<int,string> $columns
     * @return array<int,string>
     */
    public function getById(int $id, array $columns): array
    {
        return $this->db
            ->table(self::TABLE)
            ->where('id', $id)
            ->pluck(...$columns)
            ->toArray();
    }
}
