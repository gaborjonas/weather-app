<?php

declare(strict_types=1);

namespace App\Contracts;

interface GetByIdInterface
{
    /**
     * @param array<int,string> $columns
     * @return array<int,string>
     */
    public function getById(int $id, array $columns): array;

}
