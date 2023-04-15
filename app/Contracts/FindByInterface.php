<?php

declare(strict_types=1);

namespace App\Contracts;

interface FindByInterface
{
    /**
     * @param array<int,string> $columns
     * @return array<int,string>
     */
    public function getAll(array $columns): array;
}
