<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\OpenWeatherService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use GuzzleHttp\Psr7\Response;

final class OpenWeatherServiceTest extends TestCase
{
    #[Test]
    public function getCityDetailsReturnsSingleCity(): void
    {
        $response = [
            [
                'name' => 'Swansea',
                'lat' => 0.0,
                'lon' => 0.0,
            ],

        ];
        $mock = new MockHandler([new Response(200, [], (string)json_encode($response))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $service = new OpenWeatherService($client, 'apiKey');
        $cities = $service->getCityDetails('cityName');

        $this->assertCount(1, $cities);
        $this->assertSame('Swansea', $cities[0]['name']);
    }

    #[Test]
    public function getCityDetailsReturnsMultipleCity(): void
    {
        $response = [
            [
                'name' => 'Swansea',
                'country' => 'GB',
                'lat' => 0.0,
                'lon' => 0.0,
            ],
            [
                'name' => 'Swansea',
                'country' => 'US',
                'lat' => 0.0,
                'lon' => 0.0,
            ],


        ];
        $mock = new MockHandler([new Response(200, [], (string)json_encode($response))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $service = new OpenWeatherService($client, 'apiKey');
        $cities = $service->getCityDetails('cityName');

        $this->assertCount(2, $cities);
        $this->assertSame('US', $cities[0]['country']);
        $this->assertSame('GB', $cities[0]['country']);
    }

    #[Test]
    public function getCityDetailsReturnsEmptyArrayIfNoCityFound(): void
    {
        $response = [];

        $mockHandler = new MockHandler([new Response(200, [], (string)json_encode($response))]);
        $handler = HandlerStack::create($mockHandler);
        $client = new Client(['handler' => $handler]);

        $service = new OpenWeatherService($client, 'apikey', );
        $cities = $service->getCityDetails('cityName');

        $this->assertEmpty($cities);
    }

    #[Test]
    public function getCityDetailsThrowsError(): void
    {
        $mockHandler = new MockHandler([new RequestException('Error Communicating with Server', new Request('GET', 'test'))]);
        $handler = HandlerStack::create($mockHandler);
        $client = new Client(['handler' => $handler]);

        $service = new OpenWeatherService($client, 'apikey');

        $this->expectException(RequestException::class);
        $service->getCityDetails('cityName');
    }

    #[Test]
    public function getForecasts(): void
    {
        $responseOne = [
            'city' => [
                'name' => 'cityOne',
            ],
            'list' => [
                'dt' => 1681646400,
                'main' => [
                    'temp' => 20,
                ],
            ],

        ];
        $responseTwo = [
            'city' => [
                'name' => 'cityTow',
            ],
            'list' => [
                'dt' => 1681646400,
                'main' => [
                    'temp' => 10,
                ],
            ],
        ];

        $mockHandler = new MockHandler([
            new Response(200, [], (string)json_encode($responseOne)),
            new Response(200, [], (string)json_encode($responseTwo)),

        ]);
        $handler = HandlerStack::create($mockHandler);
        $client = new Client(['handler' => $handler]);

        $service = new OpenWeatherService($client, 'apiKey');
        $cities = $service->forecast(['cityOne', 'cityTwo']);


        $this->assertCount(2, $cities);
    }
}
