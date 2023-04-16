<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class StoreCityActionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function testCityIsSaved(): void
    {
        $response = $this->postJson('/api/city', ['name' => 'test']);

        $response->assertStatus(200);
        $this->assertDatabaseHas('cities', ['name' => 'test']);
    }

    #[Test]
    #[DataProvider('nameProvider')]
    public function testValidation(string $name): void
    {
        $response = $this->postJson('/api/city', ['name' => $name]);

        $response->assertStatus(422);
    }

    /**
     * @return array<string,array<int,string>>
     */
    public static function nameProvider(): array
    {
        return [
            'empty' => [''],
            'too short' => ['a'],
            'too long' => [str_repeat('a', 36)],
        ];
    }
}
