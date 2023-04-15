<?php

declare(strict_types=1);

use App\Http\Actions\FindCityAction;
use App\Http\Actions\GetForecastAction;
use App\Http\Actions\GetForecastsAction;
use App\Http\Actions\StoreCityAction;
use Illuminate\Support\Facades\Route;

Route::get('/city/find', FindCityAction::class);
Route::post('/city', StoreCityAction::class);
Route::get('/forecast', GetForecastsAction::class);
Route::get('/forecast/{cityId}', GetForecastAction::class)->whereNumber('cityId');
