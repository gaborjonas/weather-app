<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Contracts\FindByInterface;
use App\Contracts\ForecastInterface;
use Illuminate\Http\JsonResponse;

class GetForecastsAction
{
    public function __invoke(FindByInterface $repository, ForecastInterface $service): JsonResponse
    {
        $cities = $repository->getAll(['name']);

        if (empty($cities)) {
            return new JsonResponse([], 404);
        }

        $forecasts = $service->forecast($cities);

        return new JsonResponse($forecasts);
    }
}
