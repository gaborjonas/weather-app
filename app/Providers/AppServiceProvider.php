<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\FindByInterface;
use App\Contracts\ForecastInterface;
use App\Contracts\GeocodingInterface;
use App\Contracts\GetByIdInterface;
use App\Repositories\CityRepository;
use App\Services\OpenWeatherService;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GeocodingInterface::class, OpenWeatherService::class);
        $this->app->singleton(ForecastInterface::class, OpenWeatherService::class);
        $this->app->singleton(FindByInterface::class, CityRepository::class);
        $this->app->singleton(GetByIdInterface::class, CityRepository::class);


        $this->app->when(OpenWeatherService::class)
            ->needs(Client::class)
            ->give(fn () => new Client(
                [
                    'base_uri' => config('openweather.url'),
                ],
            ));

        $this->app->when(OpenWeatherService::class)
            ->needs('$apiKey')
            ->giveConfig('openweather.key');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
