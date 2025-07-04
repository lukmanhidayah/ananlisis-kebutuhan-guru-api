<?php

namespace Tests\Feature;

use Tests\TestCase;

class NotFoundApiTest extends TestCase
{
    public function test_not_found_returns_json(): void
    {
        $response = $this->getJson('/api/v1/unknown-endpoint');

        $response->assertStatus(404)
            ->assertExactJson([
                'meta' => [
                    'code' => 404,
                    'message' => 'Not Found',
                ],
                'data' => null,
            ]);
    }
}
