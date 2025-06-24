<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleApiTest extends TestCase
{
    public function test_example_endpoint_returns_template(): void
    {
        $response = $this->getJson('/api/v1/example');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => ['code', 'message'],
                'data' => ['hello'],
            ]);
    }
}
