<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\OpenWeatherService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use GuzzleHttp\Psr7\Response;

class OpenWeatherServiceTest extends TestCase
{
    private OpenWeatherService $service;

    protected function setUp(): void
    {
    }

    #[Test]
    public function getCityDetailsReturnsCities()
    {
        $response = [
            [
                'name' => 'Swansea',
                'lat' => 0.0,
                'lon' => 0.0,
            ],

        ];
        $mock = new MockHandler([new Response(200, [], json_encode($response))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $service = new OpenWeatherService($client, 'baseUrl', 'apiKey');

        $cities = $service->getCityDetails('cityName');

        $this->assertIsArray($cities);
    }

    #[Test]
    public function getCityDetailsReturnsEmptyArrayIfNoCityFound()
    {
        $response = [];

        $mockHandler = new MockHandler([new Response(200, [], json_encode($response))]);
        $handler = HandlerStack::create($mockHandler);
        $client = new Client(['handler' => $handler]);

        $service = new OpenWeatherService($client, 'baseUrl', 'apiKey');

        $cities = $service->getCityDetails('cityName');

        $this->assertEmpty($cities);
    }


}
