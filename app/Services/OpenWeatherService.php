<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ForecastInterface;
use App\Contracts\GeocodingInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
readonly class OpenWeatherService implements GeocodingInterface, ForecastInterface
{
    public function __construct(
        private Client $client,
        private string $apiKey,
    ) {
    }

    /**
     * @return array<int, mixed>
     */
    public function getCityDetails(string $cityName): array
    {
        $response = $this->client->get('/geo/1.0/direct', [
            'query' => [
                'q' => $cityName,
                'appid' => $this->apiKey,
                'limit' => 5, ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function forecast(array $cities): array
    {
        $promises = [];
        foreach ($cities as $city) {
            $promises[] =  $this->client->getAsync('/data/2.5/forecast', [
                'query' =>[
                    'q' => $city,
                    'appid' => '858f15fed9292cbe25c341a754c55e45',
                    'units' => 'metric', ],
            ]);
        }

        $responses = Promise\Utils::settle(Promise\Utils::unwrap($promises))->wait();

        $forecasts = [];
        foreach ($responses as $response) {
            $forecasts[] = json_decode($response['value']->getBody()->getContents(), true);
        }

        return $forecasts;
    }
}
