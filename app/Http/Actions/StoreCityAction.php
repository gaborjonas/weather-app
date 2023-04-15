<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Requests\StoreCityRequest;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class StoreCityAction
{
    public function __invoke(StoreCityRequest $request): JsonResponse
    {
        $city = new City();
        $city->name = (string) $request->string('name');
        $city->save();

        return new JsonResponse(['message' => "$city->name added!"]);
    }
}
