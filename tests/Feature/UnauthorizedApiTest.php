<?php

namespace Tests\Feature;

use Tests\TestCase;

class UnauthorizedApiTest extends TestCase
{
    public function test_unauthorized_returns_meta_structure(): void
    {
        $response = $this->getJson('/api/v1/menus');

        $response->assertStatus(401)
            ->assertExactJson([
                'meta' => [
                    'code' => 401,
                    'message' => 'Unauthorized',
                ],
                'data' => null,
            ]);
    }
}
