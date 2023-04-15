<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Contracts\GeocodingInterface;
use App\Http\Requests\FindCityRequest;
use Illuminate\Http\JsonResponse;

class FindCityAction
{
    public function __invoke(FindCityRequest $request, GeocodingInterface $geocoding): JsonResponse
    {
        $cities = $geocoding->getCityDetails((string)$request->string('name'));

        if (empty($cities)) {
            return new JsonResponse(['message' => 'City not found!'], 404);
        }

        return new JsonResponse($cities);
    }
}
