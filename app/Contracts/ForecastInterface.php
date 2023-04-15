<?php

declare(strict_types=1);

namespace App\Contracts;

interface ForecastInterface
{
    /**
     * @param array<int,string> $cities
     * @return array<int,string|array<int,mixed>>
     */
    public function forecast(array $cities): array;
}
