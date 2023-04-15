<?php

declare(strict_types=1);

namespace App\Contracts;

interface GeocodingInterface
{
    /**
     * @return array<int, mixed>
     */
    public function getCityDetails(string $cityName): array;
}
