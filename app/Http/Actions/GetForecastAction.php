<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Contracts\ForecastInterface;
use App\Contracts\GetByIdInterface;
use Illuminate\Http\JsonResponse;

class GetForecastAction
{
    public function __invoke(int $cityId, GetByIdInterface $repository, ForecastInterface $service): JsonResponse
    {
        $city = $repository->getById($cityId, ['name']);

        if (empty($city)) {
            return new JsonResponse([], 404);
        }

        $forecasts = $service->forecast($city);

        return new JsonResponse($forecasts);
    }
}
